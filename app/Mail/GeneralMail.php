<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectMail, $toReceiver, $viewMail;
    public array $content;

    /**
     * Create a new message instance.
     * 
     * @param string $subjectMail
     * @param string $toReceiver
     * @param string $viewMail
     * @param array $content
     */
    public function __construct(string $subjectMail, string $toReceiver, ?string $viewMail, array $content = [])
    {
        $this->subjectMail = $subjectMail;
        $this->toReceiver = $toReceiver;
        $this->viewMail = $viewMail;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectMail
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->viewMail,
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
