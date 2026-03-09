<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class ConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    public $imagePath;  
    public $summit;

    /**
     * Create a new message instance.
     */
    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'TOP2TAIL PAWRADISE CARNIVAL ATTENDANCE REWARD',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirm',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->imagePath)
                ->as('Pre-registered Online.png')
                ->withMime('image/png'),
        ];
    }
}
