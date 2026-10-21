<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array  $data,
        public string $lang = 'fr'
    ) {}

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Votre demande de prêt est en cours de traitement',
            'en' => 'Your loan request is being processed',
            'es' => 'Su solicitud de préstamo está siendo procesada',
            'pl' => 'Twój wniosek o pożyczkę jest przetwarzany',
            'bg' => 'Вашата заявка за заем се обработва',
            'hu' => 'Kölcsönkérelme feldolgozás alatt áll',
            'it' => 'La tua richiesta di prestito è in fase di elaborazione',
            'de' => 'Ihr Kreditantrag wird bearbeitet',
            'lt' => 'Jūsų paskolos paraiška yra nagrinėjama',
            'ro' => 'Cererea dumneavoastră de împrumut este în curs de procesare',
            'lv' => 'Jūsu aizdevuma pieteikums tiek apstrādāts',
            'nl' => 'Uw leningaanvraag wordt verwerkt',
            'pt' => 'O seu pedido de empréstimo está a ser processado',
        ];
        return new Envelope(subject: $subjects[$this->lang] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-confirmation',
            with: ['data' => $this->data, 'lang' => $this->lang],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
