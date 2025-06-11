<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Photographer;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PhotographerAssignedToEvent extends Mailable
{
    use SerializesModels;

    public Event $event;
    public Photographer $photographer;

    /**
     * Create a new message instance.
     */
    public function __construct(Event $event, Photographer $photographer)
    {
        $this->event = $event;
        $this->photographer = $photographer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have been assigned to a new event: ' . $this->event->event_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.photographer.assigned',
            with: [
                'eventName' => $this->event->event_name,
                'eventDate' => $this->event->date,
                'eventTime' => $this->event->time,
                'eventPlace' => $this->event->event_place,
                'photographerName' => $this->photographer->name,
                'eventUrl' => route('eventdetails.show', $this->event->id),
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
