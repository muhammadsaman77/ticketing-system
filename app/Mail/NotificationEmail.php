<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $handler, $status, $role;
    /**
     * Create a new message instance.
     */
    public function __construct(string $name, string $handler, string $status, string $role)
    {

        $this->name    = $name;
        $this->handler = $handler;
        $this->status  = $status;
        $this->role    = $role;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notif',
            with: [
                'name'    => $this->name,
                'handler' => $this->handler,
                'role'    => $this->role,
                'status'  => $this->status,
            ]
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
