<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Card;
use App\Models\CardRequest;
use App\Models\KycVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Espace « Ma carte » du client : demande de carte, suivi de la demande,
 * affichage de la carte émise, plafond de dépenses et gel temporaire.
 */
class CardController extends Controller
{
    public function show()
    {
        $user    = Auth::user();
        // Requêtes directes (pas de relation mise en cache) : l'état affiché est toujours le dernier
        $card    = $user->card()->first();
        $request = $user->cardRequests()->latest('id')->first();
        $kycOk   = $user->kycVerification()->value('status') === KycVerification::STATUS_APPROUVE;

        return view('client.app.card', compact('user', 'card', 'request', 'kycOk'));
    }

    public function requestCard(Request $request)
    {
        $user = Auth::user();

        if ($user->kycVerification()->value('status') !== KycVerification::STATUS_APPROUVE) {
            return redirect()->route('client.app.kyc.show')->with('error', __('kyc.required_notice'));
        }
        if ($user->card()->exists()) {
            return redirect()->route('client.app.card');
        }
        if ($user->cardRequests()->where('status', CardRequest::STATUS_PENDING)->exists()) {
            return redirect()->route('client.app.card')->with('error', __('banking.card_request_already'));
        }

        $data = $request->validate([
            'card_type'        => ['required', Rule::in(CardRequest::TYPES)],
            'holder_name'      => ['required', 'string', 'max:26'],
            'delivery_address' => ['nullable', 'required_if:card_type,physical', 'string', 'max:500'],
        ], [
            'delivery_address.required_if' => __('validation.required', ['attribute' => __('banking.card_delivery_address')]),
        ], [
            'holder_name'      => __('banking.card_holder'),
            'delivery_address' => __('banking.card_delivery_address'),
        ]);

        $cardRequest = $user->cardRequests()->create([
            'card_type'        => $data['card_type'],
            'holder_name'      => mb_substr(strtoupper(Str::ascii($data['holder_name'])), 0, 26),
            'delivery_address' => $data['card_type'] === 'physical' ? $data['delivery_address'] : null,
            'status'           => CardRequest::STATUS_PENDING,
        ]);

        // Prévenir les administrateurs concernés (conseiller du client + super-admins)
        try {
            $type = $data['card_type'] === 'physical' ? 'physique' : 'virtuelle';
            foreach (AdminNotification::recipientAdminIds($user) as $adminId) {
                AdminNotification::forAdmin(
                    $adminId,
                    'system',
                    'Nouvelle demande de carte',
                    "{$user->name} demande une carte {$type}.",
                    ['card_request_id' => $cardRequest->id, 'user_id' => $user->id]
                );
            }
        } catch (\Throwable $e) {
            Log::warning('Notification demande de carte : ' . $e->getMessage());
        }

        return redirect()->route('client.app.card')->with('success', __('banking.card_request_sent'));
    }

    /** Plafond de dépenses choisi par le client, borné par le plafond fixé par l'administration. */
    public function updateLimit(Request $request)
    {
        $card = Auth::user()->card()->first();
        abort_unless($card && $card->status !== Card::STATUS_BLOCKED, 403);

        $max  = min(Card::LIMIT_MAX, $card->cap());
        $data = $request->validate([
            'spending_limit' => ['required', 'integer', 'min:' . Card::LIMIT_MIN, 'max:' . max($max, Card::LIMIT_MIN)],
        ], [], ['spending_limit' => __('banking.card_limit')]);

        $card->update(['spending_limit' => $data['spending_limit']]);

        return redirect()->route('client.app.card')->with('success', __('banking.card_limit_saved'));
    }

    /** Gel / dégel temporaire de la carte par le client (une carte bloquée par l'administration reste bloquée). */
    public function toggleFreeze()
    {
        $card = Auth::user()->card()->first();
        abort_unless($card && $card->status !== Card::STATUS_BLOCKED, 403);

        $frozen = $card->status === Card::STATUS_ACTIVE;
        $card->update(['status' => $frozen ? Card::STATUS_SUSPENDED : Card::STATUS_ACTIVE]);

        return redirect()->route('client.app.card')
            ->with('success', __($frozen ? 'banking.card_frozen' : 'banking.card_unfrozen'));
    }
}
