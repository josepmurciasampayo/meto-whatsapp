<?php

namespace App\Mail;

use App\Enums\User\Role;
use App\Models\HighSchool;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InviteCounselor extends Mailable
{
    use Queueable, SerializesModels;

    public User $toUser;
    public User $fromUser;
    public HighSchool $highschool;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $toUser, User $fromUser, HighSchool $highSchool)
    {
        $this->toUser = $toUser;
        $this->fromUser = $fromUser;
        $this->highschool = $highSchool;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = (Auth()->user()->role == Role::ADMIN()) ? "Welcome to ". config('app.name') . " counselor portal; your students await!" : "You've been invited to join your colleagues on Meto";
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $view = (Auth()->user()->role == Role::ADMIN()) ? "mail.inviteCounselorFromAdmin" : 'mail.inviteCounselor';
        return new Content(
            view: $view,
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
