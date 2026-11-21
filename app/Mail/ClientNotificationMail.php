<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail envoyé au client pour toute notification de son espace (dépôt, débit, carte, facture payée,
 * blocage, réponse du support…) qui n'a pas déjà son propre e-mail. Le titre et le texte sont ceux de
 * la notification, déjà traduits dans la langue du client ; le reste de l'e-mail suit cette même langue.
 */
class ClientNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $mailLocale;

    public function __construct(
        public User $client,
        public string $notifTitle,
        public string $notifBody,
        public string $notifType = 'system',
        public array $details = [],
    ) {
        $this->mailLocale = $client->locale ?: 'fr';
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->notifTitle . ' — ' . site_name());
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.client-notification',
            with: [
                'client'   => $this->client,
                'title'    => $this->notifTitle,
                'body'     => $this->notifBody,
                'type'     => $this->notifType,
                'amount'   => isset($this->details['amount']) && is_numeric($this->details['amount']) ? (float) $this->details['amount'] : null,
                'currency' => $this->details['currency'] ?? null,
                'note'     => $this->details['note'] ?? null,
                'locale'   => $this->mailLocale,
            ],
        );
    }
}
