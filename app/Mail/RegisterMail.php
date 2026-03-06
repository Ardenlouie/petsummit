<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pet;
    public $pdfContent;
    
    public function __construct($pet, $pdfContent = null)
    {
        $this->pet = $pet;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'TOP2TAIL PAWRADISE CARNIVAL SHOW PASS',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.register',
        );
    }

    public function build()
    {
        return $this->view('emails.register')
                    ->with('pet', $this->pet);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'CARNIVAL-SHOW-PASS.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
