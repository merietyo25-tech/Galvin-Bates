<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class LoanValidationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LoanRequest $loan,
        public string      $mailSubject,
        public string      $htmlBody,
        public ?string      $pdfPath = null,
        public string      $amortizationPdfPath = '',
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
                'title'      => $this->mailSubject,
                'body'       => $this->htmlBody,
                'locale'     => $this->loan->contract_language ?? 'fr',
                'outcomeUrl' => URL::signedRoute('loan.outcome.approved', ['loan' => $this->loan]),
            ],
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $attachments[] = Attachment::fromPath($this->pdfPath)
                ->as($this->loan->documentFileName('notification'))
                ->withMime('application/pdf');
        }

        if ($this->amortizationPdfPath && file_exists($this->amortizationPdfPath)) {
            $attachments[] = Attachment::fromPath($this->amortizationPdfPath)
                ->as($this->loan->documentFileName('amortization'))
                ->withMime('application/pdf');
        }

        return $attachments;
    }
}
