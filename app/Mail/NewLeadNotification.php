<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewLeadNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $leadName;
    public $leadEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(string $name, string $email)
    {
        $this->leadName = $name;
        $this->leadEmail = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Lead Captured: ' . $this->leadName,
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->leadEmail, $this->leadName)
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new_lead',
            with: [
                'leadName' => $this->leadName,
                'leadEmail' => $this->leadEmail,
            ],
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
