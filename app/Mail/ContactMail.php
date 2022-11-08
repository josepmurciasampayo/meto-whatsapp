<?php

namespace App\Mail;

use App\Enums\User\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $text;
    public $user_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $email, string $phone, string $message, int $user_id)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->text = $message;
        $this->user_id = $user_id;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope() :Envelope
    {
        $subject = "Contact Us from " . $this->name;
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content() :Content
    {
        $view = 'mail.contact';
        return new Content(
            view: $view,
        );
    }
}
