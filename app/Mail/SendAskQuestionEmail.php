<?php

namespace App\Mail;

use App\Models\Connection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAskQuestionEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Connection
     */
    public Connection $studentUniversity;

    /**
     * @var string
     */
    public string $question;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Connection $studentUniversity, string $question)
    {
        $this->studentUniversity = $studentUniversity;

        $this->question = $question;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Question from Meto Student: ' . auth()->user()->getFullName()
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
            view: 'connections.ask_question',
            with: [
                'connectionRequest' => $this->studentUniversity,
                'question' => $this->question
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
