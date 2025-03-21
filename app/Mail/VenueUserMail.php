<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VenueUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $venueUser;
    protected $venueUserProfile;

    public function __construct($venueUser, $venueUserProfile)
    {
        \Log::info('mail');
        $this->venueUser = $venueUser;
        $this->venueUserProfile = $venueUserProfile;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'pandiselvi@reydelmercado.com',
            subject: "Mangal Mall Registration Successfull!",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.venueuser_mail',
            with: [
                'venueUser' => $this->venueUser,
                'venueUserProfile' => $this->venueUserProfile,
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
