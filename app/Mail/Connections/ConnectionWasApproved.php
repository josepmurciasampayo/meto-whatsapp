<?php

namespace App\Mail\Connections;

use App\Models\Student;
use App\Models\StudentUniversity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConnectionWasApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $connection;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(StudentUniversity $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: config('app.name') . ' College Connection',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return (new Content(
            markdown: 'connections.connection_was_approved',
        ))->with([
            'connection' => $this->connection
        ]);
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
