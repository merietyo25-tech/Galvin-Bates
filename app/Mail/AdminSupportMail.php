<?php

namespace App\Mail;

use App\Models\SupportMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminSupportMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $locale;

    public function __construct(
        public User $client,
        public SupportMessage $message,
        ?string $locale = null,
    ) {
        $this->locale = $locale ?? 'fr';
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Nouveau message de ' . $this->client->name . ' — Support ' . site_name(),
            'en' => 'New message from ' . $this->client->name . ' — ' . site_name() . ' Support',
            'es' => 'Nuevo mensaje de ' . $this->client->name . ' — Soporte ' . site_name(),
            'pl' => 'Nowa wiadomość od ' . $this->client->name . ' — Wsparcie ' . site_name(),
            'bg' => 'Ново съобщение от ' . $this->client->name . ' — Поддръжка ' . site_name(),
            'hu' => 'Új üzenet — ' . $this->client->name . ' — ' . site_name() . ' ügyfélszolgálat',
            'it' => 'Nuovo messaggio da ' . $this->client->name . ' — Assistenza ' . site_name(),
            'de' => 'Neue Nachricht von ' . $this->client->name . ' — ' . site_name() . ' Support',
            'lt' => 'Naujas pranešimas nuo ' . $this->client->name . ' — ' . site_name() . ' pagalba',
            'ro' => 'Mesaj nou de la ' . $this->client->name . ' — Suport ' . site_name(),
            'lv' => 'Jauns ziņojums no ' . $this->client->name . ' — ' . site_name() . ' atbalsts',
            'nl' => 'Nieuw bericht van ' . $this->client->name . ' — ' . site_name() . ' Support',
            'pt' => 'Nova mensagem de ' . $this->client->name . ' — Suporte ' . site_name(),
        ];

        return new Envelope(
            subject: $subjects[$this->locale] ?? $subjects['fr'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-support',
            with: ['locale' => $this->locale],
        );
    }
}
