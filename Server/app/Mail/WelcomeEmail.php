<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $user;
    public $name;
    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
         $this->user = $user;
        $this->name = $user->name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Qelem Meda Mini Payroll System Registeration is Successful', 
        );
    }

    /**
     * Get the message content definition.
     */
     public function content(): Content
    {
        return new Content(
            view: 'emails.salary_notification',
            with: [
                'name' => $this->name,
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
