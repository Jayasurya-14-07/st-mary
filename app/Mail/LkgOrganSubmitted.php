<?php

namespace App\Mail;

use App\Models\LkgOrgan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LkgOrganSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $lkgOrgan;

    /**
     * Create a new message instance.
     */
    public function __construct(LkgOrgan $lkgOrgan)
    {
        $this->lkgOrgan = $lkgOrgan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New LKG Organ Form Submission (BBB ORGAN FORM 2)',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lkg_organ_submitted',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
