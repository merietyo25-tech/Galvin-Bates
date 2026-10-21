<?php

namespace App\Mail;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminTransferMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $locale;

    public function __construct(
        public User $client,
        public Transfer $transfer,
        ?string $locale = null,
    ) {
        $this->locale = $locale ?? 'fr';
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'fr' => 'Nouveau virement en attente — ' . $this->client->name,
            'en' => 'New transfer pending — ' . $this->client->name,
            'es' => 'Nueva transferencia pendiente — ' . $this->client->name,
            'pl' => 'Nowy przelew oczekujący — ' . $this->client->name,
            'bg' => 'Нов чакащ превод — ' . $this->client->name,
            'hu' => 'Új függőben lévő átutalás — ' . $this->client->name,
            'it' => 'Nuovo bonifico in attesa — ' . $this->client->name,
            'de' => 'Neue ausstehende Überweisung — ' . $this->client->name,
            'lt' => 'Naujas laukiantis pavedimas — ' . $this->client->name,
            'ro' => 'Transfer nou în așteptare — ' . $this->client->name,
            'lv' => 'Jauns gaidošs pārvedums — ' . $this->client->name,
            'nl' => 'Nieuwe openstaande overschrijving — ' . $this->client->name,
            'pt' => 'Nova transferência pendente — ' . $this->client->name,
        ];

        return new Envelope(
            subject: $subjects[$this->locale] ?? $subjects['fr'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-transfer',
            with: ['locale' => $this->locale],
        );
    }
}
