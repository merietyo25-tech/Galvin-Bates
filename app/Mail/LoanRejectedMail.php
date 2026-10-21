<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class LoanRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $reason,
    ) {}

    public function envelope(): Envelope
    {
        $locale = $this->loan->contract_language ?? 'fr';
        $ref    = $this->loan->reference;

        $subjects = [
            'fr' => "Dossier {$ref} — Demande refusée",
            'en' => "File {$ref} — Request declined",
            'pl' => "Wniosek {$ref} — Wniosek odrzucony",
            'es' => "Expediente {$ref} — Solicitud rechazada",
            'bg' => "Досие {$ref} — Заявката е отхвърлена",
            'hu' => "Ügy {$ref} — Kérelem elutasítva",
            'it' => "Pratica {$ref} — Richiesta respinta",
            'de' => "Akte {$ref} — Antrag abgelehnt",
            'lt' => "Byla {$ref} — Paraiška atmesta",
            'ro' => "Dosar {$ref} — Cerere respinsă",
            'lv' => "Lieta {$ref} — Pieteikums noraidīts",
            'nl' => "Dossier {$ref} — Aanvraag afgewezen",
            'pt' => "Processo {$ref} — Pedido recusado",
        ];

        return new Envelope(subject: $subjects[$locale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-rejected',
            with: [
                'loan'       => $this->loan,
                'locale'     => $this->loan->contract_language ?? 'fr',
                'reason'     => $this->reason,
                'outcomeUrl' => URL::signedRoute('loan.outcome.rejected', ['loan' => $this->loan]),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
