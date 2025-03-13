<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CaretakerCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $caretaker;
    protected $guestCaretakers;
    protected $action;

    public function __construct($caretaker, $guestCaretakers, $action)
    {
        \Log::info('mail');
        $this->caretaker = $caretaker;
        $this->guestCaretakers = $guestCaretakers;
        $this->action = $action;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'pandiselvi@reydelmercado.com',
            subject: $this->action == 'add' ? 'Caretaker Assigned' : "Updated Caretaker's Guest Details",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.caretaker_mail',
            with: [
                'caretaker' => $this->caretaker,
                'guestCaretakers' => $this->guestCaretakers,
                'action' => $this->action
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
