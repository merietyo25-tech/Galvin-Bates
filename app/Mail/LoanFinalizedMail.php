<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanFinalizedMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $mailLocale;

    public function __construct(
        public LoanRequest $loan,
        public bool         $credited,
        string              $locale = 'fr',
    ) {
        $this->mailLocale = $locale;
    }

    public function envelope(): Envelope
    {
        $ref = $this->loan->reference;

        $subjects = [
            'credited' => [
                'fr' => "Dossier {$ref} finalisé — Fonds crédités — " . site_name(),
                'en' => "File {$ref} finalized — Funds credited — " . site_name(),
                'es' => "Expediente {$ref} finalizado — Fondos abonados — " . site_name(),
                'pl' => "Wniosek {$ref} sfinalizowany — Środki zaksięgowane — " . site_name(),
                'bg' => "Досие {$ref} финализирано — Средствата са преведени — " . site_name(),
                'hu' => "A(z) {$ref} ügy véglegesítve — Összeg jóváírva — " . site_name(),
                'it' => "Pratica {$ref} finalizzata — Fondi accreditati — " . site_name(),
                'de' => "Akte {$ref} abgeschlossen — Betrag gutgeschrieben — " . site_name(),
                'lt' => "Byla {$ref} užbaigta — Lėšos pervestos — " . site_name(),
                'ro' => "Dosarul {$ref} finalizat — Fonduri creditate — " . site_name(),
                'lv' => "Lieta {$ref} pabeigta — Līdzekļi ieskaitīti — " . site_name(),
                'nl' => "Dossier {$ref} afgerond — Bedrag gestort — " . site_name(),
                'pt' => "Processo {$ref} finalizado — Fundos creditados — " . site_name(),
            ],
            'not_credited' => [
                'fr' => "Dossier {$ref} finalisé — " . site_name(),
                'en' => "File {$ref} finalized — " . site_name(),
                'es' => "Expediente {$ref} finalizado — " . site_name(),
                'pl' => "Wniosek {$ref} sfinalizowany — " . site_name(),
                'bg' => "Досие {$ref} финализирано — " . site_name(),
                'hu' => "A(z) {$ref} ügy véglegesítve — " . site_name(),
                'it' => "Pratica {$ref} finalizzata — " . site_name(),
                'de' => "Akte {$ref} abgeschlossen — " . site_name(),
                'lt' => "Byla {$ref} užbaigta — " . site_name(),
                'ro' => "Dosarul {$ref} finalizat — " . site_name(),
                'lv' => "Lieta {$ref} pabeigta — " . site_name(),
                'nl' => "Dossier {$ref} afgerond — " . site_name(),
                'pt' => "Processo {$ref} finalizado — " . site_name(),
            ],
        ];

        $key = $this->credited ? 'credited' : 'not_credited';

        return new Envelope(subject: $subjects[$key][$this->mailLocale] ?? $subjects[$key]['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-finalized',
            with: [
                'loan'     => $this->loan,
                'credited' => $this->credited,
                'locale'   => $this->mailLocale,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
