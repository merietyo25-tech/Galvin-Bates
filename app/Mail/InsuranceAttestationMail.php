<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InsuranceAttestationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $mailSubject,
        public string      $htmlBody,
        public string      $pdfPath,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->mailSubject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notification-template',
            with: [
                'title'  => $this->mailSubject,
                'body'   => $this->htmlBody,
                'locale' => $this->loan->contract_language ?? 'fr',
            ],
        );
    }

    public function attachments(): array
    {
        if (!file_exists($this->pdfPath)) {
            return [];
        }

        return [
            Attachment::fromPath($this->pdfPath)
                ->as($this->loan->documentFileName('insurance'))
                ->withMime('application/pdf'),
        ];
    }
}
