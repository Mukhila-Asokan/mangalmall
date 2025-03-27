<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class ShareMail extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;
    public $event;
    protected $eventItinerary;
    public $attachements;

    /**
     * Create a new message instance.
     */
    public function __construct($guest, $event, $eventItinerary, $attachements)
    {
        $this->guest = $guest;
        $this->event = $event;
        $this->eventItinerary = $eventItinerary;
        $this->attachements = $attachements;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'pandiselvi@reydelmercado.com',
            subject: 'Event shared with you!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        try{
            return new Content(
                view: 'mail.share_mail',
                with: [
                    'guest' => $this->guest,
                    'eventItinerary' => $this->eventItinerary,
                    'event' => $this->event,
                ],
            );
        }
        catch(\Exception $e){
            dd($e);
    }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */

    public function attachments(): array
    {
        return $this->attachements;
    }
}
