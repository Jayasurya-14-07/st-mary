<?php

namespace App\Mail;

use App\Models\BbbOrgan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BbbOrganSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $bbbOrgan;

    /**
     * Create a new message instance.
     */
    public function __construct(BbbOrgan $bbbOrgan)
    {
        $this->bbbOrgan = $bbbOrgan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New BBB Organ Form Submission',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bbb_organ_submitted',
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
