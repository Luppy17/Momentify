<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserRegisteredNotification extends Mailable
{
    use SerializesModels;

    public User $newUser;
    public ?string $managementLink; // Link can be null if no specific link for a role

    /**
     * Create a new message instance.
     */
    public function __construct(User $newUser, ?string $managementLink)
    {
        $this->newUser = $newUser;
        $this->managementLink = $managementLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New User Registration Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $roleName = 'User'; // Default role name
        if ($this->newUser->is_event_manager) {
            $roleName = 'Event Manager';
        } elseif ($this->newUser->is_photographer) {
            $roleName = 'Photographer';
        }

        return new Content(
            markdown: 'emails.notifications.new_user_registered',
            with: [
                'newUser' => $this->newUser,
                'managementLink' => $this->managementLink,
                'roleName' => $roleName,
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
