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

    public $uni;

    public $createdConnections;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student, $createdConnections)
    {
        $this->uni = Auth()->user()->getUni();

        $this->createdConnections = $createdConnections;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New connection request(s)'
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $connections = $this->createdConnections;

        foreach ($connections as $connection) {
            $connection->student = Student::find($connection->student_id);
            $connection->student->user = User::find($connection->student->user_id);
        }

        return new Content(
            view: 'connections.send_request',
            with: [
                'uni' => $this->uni,
                'createdConnections' => $connections
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
