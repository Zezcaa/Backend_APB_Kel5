<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetCode;

    /**
     * Create a new message instance.
     */
    public function __construct($resetCode)
    {
        $this->resetCode = $resetCode;
    }

    /**
    * Get the message envelope.
    */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Reset Password Anda',
        );
    }

    /**
    * Get the message content definition.
    */
    public function content(): Content
    {
        return new Content(
            // Arahkan ke file view untuk tampilan email
            view: 'emails.password-reset-email', 
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