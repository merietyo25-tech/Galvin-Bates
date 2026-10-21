<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanRequestApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $mailLocale = 'fr',
    ) {}

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Votre demande N°' . $this->loan->reference . ' a été approuvée — ' . site_name(),
            'en' => 'Your application N°' . $this->loan->reference . ' has been approved — ' . site_name(),
            'es' => 'Su solicitud N°' . $this->loan->reference . ' ha sido aprobada — ' . site_name(),
            'pl' => 'Wniosek nr ' . $this->loan->reference . ' został zatwierdzony — ' . site_name(),
            'bg' => 'Вашата заявка №' . $this->loan->reference . ' беше одобрена — ' . site_name(),
            'hu' => 'Kérelme sz. ' . $this->loan->reference . ' jóváhagyásra került — ' . site_name(),
            'it' => 'La tua richiesta N°' . $this->loan->reference . ' è stata approvata — ' . site_name(),
            'de' => 'Ihr Antrag Nr. ' . $this->loan->reference . ' wurde genehmigt — ' . site_name(),
            'lt' => 'Jūsų paraiška Nr. ' . $this->loan->reference . ' buvo patvirtinta — ' . site_name(),
            'ro' => 'Cererea dumneavoastră nr. ' . $this->loan->reference . ' a fost aprobată — ' . site_name(),
            'lv' => 'Jūsu pieteikums Nr. ' . $this->loan->reference . ' ir apstiprināts — ' . site_name(),
            'nl' => 'Uw aanvraag nr. ' . $this->loan->reference . ' is goedgekeurd — ' . site_name(),
            'pt' => 'O seu pedido N.º' . $this->loan->reference . ' foi aprovado — ' . site_name(),
        ];

        return new Envelope(subject: $subjects[$this->mailLocale] ?? $subjects['fr']);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-approved',
            with: ['loan' => $this->loan, 'locale' => $this->mailLocale],
        );
    }
}
