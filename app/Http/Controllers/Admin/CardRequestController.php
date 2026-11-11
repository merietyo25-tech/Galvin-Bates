<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CardRequest;
use App\Models\ClientNotification;
use App\Services\BankingProvisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/** Demandes de carte des clients : liste, validation (émission de la carte) et refus. */
class CardRequestController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', CardRequest::STATUS_PENDING);
        if (! in_array($status, [CardRequest::STATUS_PENDING, CardRequest::STATUS_APPROVED, CardRequest::STATUS_REJECTED, 'all'], true)) {
            $status = CardRequest::STATUS_PENDING;
        }

        $requests = CardRequest::with(['user:id,uuid,name,email', 'reviewer:id,name'])
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(20)
            ->appends($request->query());

        $pendingCount = CardRequest::where('status', CardRequest::STATUS_PENDING)->count();

        return view('admin.card-requests.index', compact('requests', 'status', 'pendingCount'));
    }

    public function approve(CardRequest $cardRequest, BankingProvisioner $provisioner)
    {
        abort_unless($cardRequest->isPending(), 422, 'Cette demande a déjà été traitée.');

        $client = $cardRequest->user;

        DB::transaction(function () use ($cardRequest, $client, $provisioner) {
            // La carte est rattachée au compte : on crée l'IBAN s'il n'existe pas encore
            $provisioner->provision($client, Auth::id());
            $provisioner->issueCard($client, Auth::id(), $cardRequest->card_type, $cardRequest->holder_name);

            $cardRequest->update([
                'status'      => CardRequest::STATUS_APPROVED,
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);
        });

        ClientNotification::notifyUser($client, 'system', 'banking.notif_card_approved', 'banking.notif_card_approved_body');

        return back()->with('success', "Carte émise pour {$client->name}.");
    }

    public function reject(Request $request, CardRequest $cardRequest)
    {
        abort_unless($cardRequest->isPending(), 422, 'Cette demande a déjà été traitée.');

        $data = $request->validate(['reason' => ['required', 'string', 'max:500']], [], ['reason' => 'motif']);

        $cardRequest->update([
            'status'           => CardRequest::STATUS_REJECTED,
            'reviewed_by'      => Auth::id(),
            'reviewed_at'      => now(),
            'rejection_reason' => $data['reason'],
        ]);

        ClientNotification::notifyUser(
            $cardRequest->user, 'system',
            'banking.notif_card_rejected', 'banking.notif_card_rejected_body',
            ['reason' => $data['reason']]
        );

        return back()->with('success', 'Demande de carte refusée.');
    }
}
