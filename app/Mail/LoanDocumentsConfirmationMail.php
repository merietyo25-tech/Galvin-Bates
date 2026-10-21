<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanDocumentsConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array  $data,
        public string $lang = 'fr'
    ) {}

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Vos documents ont bien été reçus',
            'en' => 'Your documents have been received',
            'es' => 'Sus documentos han sido recibidos',
            'pl' => 'Twoje dokumenty zostały odebrane',
            'bg' => 'Вашите документи бяха получени успешно',
            'hu' => 'Dokumentumait sikeresen megkaptuk',
            'it' => 'I tuoi documenti sono stati ricevuti correttamente',
            'de' => 'Ihre Unterlagen sind bei uns eingegangen',
            'lt' => 'Jūsų dokumentai buvo sėkmingai gauti',
            'ro' => 'Documentele dumneavoastră au fost primite cu succes',
            'lv' => 'Jūsu dokumenti ir veiksmīgi saņemti',
            'nl' => 'Uw documenten zijn goed ontvangen',
            'pt' => 'Os seus documentos foram recebidos com sucesso',
        ];
        return new Envelope(subject: $subjects[$this->lang] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-documents-confirmation',
            with: ['data' => $this->data, 'lang' => $this->lang],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
