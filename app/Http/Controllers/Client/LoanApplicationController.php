<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\LoanMail;
use App\Models\AdminNotification;
use App\Models\ClientNotification;
use App\Models\Currency;
use App\Models\LoanHistory;
use App\Models\LoanRequest;
use App\Models\LoanSetting;
use App\Services\LoanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Demande de prêt faite par le client depuis son application.
 * Le dossier est créé « en attente » et suit ensuite le circuit habituel côté administration
 * (validation, contrat, signature, déblocage des fonds).
 */
class LoanApplicationController extends Controller
{
    /** Durées proposées (mois). */
    public const DURATIONS = [6, 12, 18, 24, 36, 48, 60, 72, 84, 96, 120, 180, 240, 300, 360];

    public function __construct(private LoanService $loanService) {}

    public function create()
    {
        $user     = Auth::user();
        $settings = LoanSetting::current();

        return view('client.app.loans.create', [
            'user'      => $user,
            'rate'      => (float) $settings->annual_rate,
            'min'       => (float) ($settings->min_amount ?: 100),
            'max'       => (float) ($settings->max_amount ?: 1000000),
            'currency'  => $user->currency ?? Currency::default(),
            'durations' => self::DURATIONS,
            'types'     => array_keys(LoanRequest::FINANCING_TYPES),
        ]);
    }

    public function store(Request $request)
    {
        $user     = Auth::user();
        $settings = LoanSetting::current();
        $min      = (float) ($settings->min_amount ?: 100);
        $max      = (float) ($settings->max_amount ?: 1000000);

        $data = $request->validate([
            'amount'           => "required|numeric|min:$min|max:$max",
            'darly'            => 'required|integer|in:' . implode(',', self::DURATIONS),
            'type_financement' => 'required|in:' . implode(',', array_keys(LoanRequest::FINANCING_TYPES)),
            'objet'            => 'required|string|max:255',
            'subject'          => 'nullable|string|max:2000',
            'phone'            => ($user->phone ? 'nullable' : 'required') . '|string|max:50',
            'address'          => ($user->address ? 'nullable' : 'required') . '|string|max:255',
            'accept'           => 'accepted',
        ], [], [
            'amount'           => __('app.loanreq_amount'),
            'darly'            => __('app.loanreq_duration'),
            'type_financement' => __('app.loanreq_type'),
            'objet'            => __('app.loanreq_purpose'),
            'subject'          => __('app.loanreq_details'),
            'accept'           => __('app.loanreq_accept_short'),
            'phone'            => __('app.loanreq_phone'),
            'address'          => __('app.loanreq_address'),
        ]);

        $rate     = (float) $settings->annual_rate;
        $calc     = $this->loanService->calculateAll((float) $data['amount'], $rate, (int) $data['darly']);
        $currency = $user->currency ?? Currency::default();

        // Coordonnées manquantes : enregistrées aussi dans le profil du client
        $profile = array_filter([
            'phone'   => $user->phone ? null : ($data['phone'] ?? null),
            'address' => $user->address ? null : ($data['address'] ?? null),
        ]);
        if ($profile) {
            $user->update($profile);
        }

        $loan = DB::transaction(function () use ($user, $data, $calc, $rate, $currency) {
            $loan = LoanRequest::create([
                'reference'             => LoanRequest::generateReference(),
                'archive_ref'           => 'CR-ARCH-' . strtoupper(Str::random(8)),
                // Conseiller du client (sinon un super-admin pourra l'attribuer)
                'admin_id'              => AdminNotification::recipientAdminIds($user)->first(),
                'client_id'             => $user->id,
                'name'                  => $user->name,
                'email'                 => $user->email,
                'phone'                 => $user->phone,
                'address'               => $user->address,
                'amount'                => $data['amount'],
                'interest_rate'         => $rate,
                'currency'              => $currency,
                'start_date'            => now()->toDateString(),
                'darly'                 => $data['darly'],
                'objet'                 => $data['objet'],
                'type_financement'      => $data['type_financement'],
                'subject'               => $data['subject'] ?? null,
                'monthly_payment'       => $calc['monthly_payment'],
                'total_cost'            => $calc['total_cost'],
                'total_with_interest'   => $calc['total_with_interest'],
                'amortization_schedule' => $calc['amortization_schedule'],
                'contract_language'     => $user->locale ?: 'fr',
                'status'                => LoanRequest::STATUS_PENDING,
            ]);

            LoanHistory::create([
                'loan_request_id' => $loan->id,
                'admin_id'        => null,
                'action'          => 'created_by_client',
                'old_value'       => null,
                'new_value'       => ['status' => $loan->status, 'source' => 'app'],
            ]);

            // Administration : notification dans le tableau de bord
            $amount = number_format((float) $loan->amount, 2, ',', ' ') . ' ' . $currency;
            foreach (AdminNotification::recipientAdminIds($user) as $adminId) {
                AdminNotification::forAdmin($adminId, 'loan', 'Nouvelle demande de prêt — ' . $user->name,
                    "{$loan->reference} : {$amount} sur {$loan->darly} mois", ['loan_id' => $loan->id, 'loan_key' => $loan->getRouteKey(), 'client_id' => $user->id]);
            }

            // Client : notification + e-mail de confirmation dans sa langue
            ClientNotification::notifyUser($user, 'loan_update', 'app.notif_loan_submitted', 'app.notif_loan_submitted_body',
                ['reference' => $loan->reference, 'amount' => $amount],
                ['loan_id' => $loan->id, 'reference' => $loan->reference]);

            return $loan;
        });

        // E-mail à l'adresse qui reçoit les demandes de prêt (comme le formulaire du site)
        try {
            $to = LoanSetting::current()->notification_email ?: site_email();
            Mail::to($to)->send(new LoanMail([
                'name'     => $user->name,
                'email'    => $user->email,
                'phone'    => $loan->phone ?? '—',
                'country'  => $user->country,
                'amount'   => $loan->amount,
                'currency' => $currency,
                'darly'    => $loan->darly,
                'subject'  => $loan->reference . ' — ' . (LoanRequest::FINANCING_TYPES[$loan->type_financement] ?? $loan->type_financement),
                'objet'    => trim($loan->objet . ($loan->subject ? "\n" . $loan->subject : '')),
            ], 'fr'));
        } catch (\Throwable $e) {
            Log::error('LoanMail (demande depuis l\'application) : ' . $e->getMessage());
        }

        return redirect()->route('client.app.loans.show', $loan)
            ->with('success', __('app.loanreq_sent', ['reference' => $loan->reference]));
    }
}
