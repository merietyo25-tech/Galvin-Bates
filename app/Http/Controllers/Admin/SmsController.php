<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendSmsJob;
use App\Models\SmsMessage;
use App\Models\SmsSetting;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SmsController extends Controller
{
    public function index()
    {
        $clients = User::where('type', 'client')
            ->whereNotNull('phone')->where('phone', '!=', '')
            ->orderBy('name')->get(['id', 'name', 'phone']);

        $history      = SmsMessage::with('user:id,name')->latest()->paginate(20);
        // État réel des SMS encore en attente chez la passerelle (téléphone pas encore passé)
        app(SmsService::class)->refreshStatuses($history->getCollection());
        $settings     = SmsSetting::current();
        $canConfigure = Auth::user()->hasRole('super-admin') || Auth::user()->can('manage-sms');

        return view('admin.sms.index', compact('clients', 'history', 'settings', 'canConfigure'));
    }

    public function send(Request $request, SmsService $sms)
    {
        $data = $request->validate([
            'mode'         => ['required', 'in:single,selected,all'],
            'number'       => ['required_if:mode,single', 'nullable', 'string', 'max:32'],
            'client_ids'   => ['required_if:mode,selected', 'nullable', 'array'],
            'client_ids.*' => ['integer'],
            'message'      => ['required', 'string', 'max:480'],
        ], [
            'number.required_if'     => 'Saisissez un numéro de téléphone.',
            'client_ids.required_if' => 'Sélectionnez au moins un client.',
        ]);

        $recipients = []; // [phone, userId]
        if ($data['mode'] === 'single') {
            $recipients[] = [$data['number'], null];
        } else {
            $q = User::where('type', 'client')->whereNotNull('phone')->where('phone', '!=', '');
            if ($data['mode'] === 'selected') {
                $q->whereIn('id', $data['client_ids']);
            }
            foreach ($q->get(['id', 'phone']) as $u) {
                $recipients[] = [$u->phone, $u->id];
            }
        }

        if (! $recipients) {
            return back()->withInput()->withErrors(['message' => 'Aucun destinataire avec un numéro de téléphone.']);
        }

        // Un seul destinataire : envoi immédiat, avec le vrai résultat (pas besoin de worker)
        if (count($recipients) === 1) {
            [$phone, $userId] = $recipients[0];
            $r = $sms->send($phone, $data['message'], $userId, Auth::id());

            return redirect()->route('admin.sms.index')->with(
                $r['ok'] ? 'success' : 'error',
                $r['ok']
                    ? (! empty($r['gateway_id']) ? "SMS transmis à la passerelle : il part dès que le téléphone le récupère (voir l'état dans l'historique)." : 'SMS envoyé.')
                    : "Échec de l'envoi : " . $r['error']
            );
        }

        set_time_limit(0);
        $batch  = (string) Str::uuid();
        $queued = $invalid = 0;

        foreach ($recipients as [$phone, $userId]) {
            $message = $sms->enqueue($phone, $data['message'], $userId, Auth::id(), $batch);
            if ($message->status === 'pending') {
                SendSmsJob::dispatch($message);
                $queued++;
            } else {
                $invalid++;
            }
        }

        // Avec QUEUE_CONNECTION=sync les envois ont déjà eu lieu ; sinon un worker les traite en arrière-plan.
        $async = config('queue.default') !== 'sync';
        $msg   = $queued . ($async ? ' SMS mis en file d\'attente (envoi en arrière-plan)' : ' SMS traité(s)')
               . ($invalid ? ", {$invalid} numéro(s) invalide(s)" : '') . '.';

        return redirect()->route('admin.sms.index')->with($queued ? 'success' : 'error', $msg);
    }

    public function updateSettings(Request $request)
    {
        abort_unless(Auth::user()->hasRole('super-admin') || Auth::user()->can('manage-sms'), 403);

        $data = $request->validate([
            'driver'               => ['required', 'in:android_gateway,log'],
            'api_url'              => ['nullable', 'string', 'max:255', 'required_if:driver,android_gateway'],
            'username'             => ['nullable', 'string', 'max:100'],
            'password'             => ['nullable', 'string', 'max:200'],
            'default_country_code' => ['nullable', 'regex:/^\+?\d{1,4}$/'],
            'sim_number'           => ['nullable', 'in:1,2,3'],
        ]);

        // Actif dès que la passerelle est renseignée (ou en mode test)
        $data['enabled']              = $data['driver'] === 'log' || ! empty($data['api_url']);
        $data['sim_number']           = $data['sim_number'] ?? null;
        $data['default_country_code'] = ltrim((string) ($data['default_country_code'] ?? ''), '+');
        if (empty($data['password'])) {
            unset($data['password']); // conserve le mot de passe existant
        }

        SmsSetting::current()->update($data);

        return back()->with('success', 'Paramètres SMS enregistrés.');
    }
}
