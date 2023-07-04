<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionOccured extends Mailable
{
    use Queueable, SerializesModels;

    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = config('exceptions.emailExceptionSubject') . ' - ' . $this->content['ip'];

        return $this->from('error@meto-intl.org')
            ->to('greg@meto-intl.org')
            ->cc('abraham@meto-intl.org')
            ->subject($subject)
            ->view('mail.exception')
            ->with('content', $this->content);
    }
}
