<?php

namespace App\Mail;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UniInvite extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Institution $uni;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Institution $uni)
    {
        $this->user = $user;
        $this->uni = $uni;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Welcome to Meto! Your database is ready.',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.uniInvite',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
