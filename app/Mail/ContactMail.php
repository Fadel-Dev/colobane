<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $isConfirmation;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact, $isConfirmation = false)
    {
        $this->contact = $contact;
        $this->isConfirmation = $isConfirmation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if ($this->isConfirmation) {
            return new Envelope(
                subject: 'Confirmation de réception - NoflayHub',
            );
        }

        return new Envelope(
            subject: 'Nouveau message de contact - ' . $this->contact->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->isConfirmation) {
            return new Content(
                view: 'emails.contact-confirmation',
            );
        }

        return new Content(
            view: 'emails.contact-notification',
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
