<?php

namespace App\Mail\Connections;

use App\Models\Connection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConnectionWasDenied extends Mailable
{
    use Queueable, SerializesModels;

    public Connection $studentUniversity;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Connection $connection)
    {
        $this->studentUniversity = $connection;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Connection was denied',
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
            markdown: 'connections.connection_was_denied',
        ))->with([
            'connection' => $this->studentUniversity
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
