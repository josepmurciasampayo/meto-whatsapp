<?php

namespace App\Mail;

use App\Models\Student;
use App\Models\StudentUniversity;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendConnectionRequestToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    public $user;

    public $createdConnection;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student, StudentUniversity $createdConnection)
    {
        $this->student = $student;

        $this->user = User::find($student->user_id);

        $this->createdConnection = $createdConnection;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New connection request from ' . $this->user->first . ' ' . $this->user->last
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
            view: 'connections.send_request',
            with: [
                'student' => $this->student,
                'user' => $this->user,
                'createdConnection' => $this->createdConnection
            ]
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
