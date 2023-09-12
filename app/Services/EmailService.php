<?php

namespace App\Services;

use App\Models\Email;
use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * @var Mailable
     */
    protected static Mailable $mailable;

    /**
     * @var string
     */
    protected static string $emailKey;

    /**
     * @var string|array
     */
    protected static string|array $recipients;

    /**
     * @var string|array
     */
    protected static string|array $cc;

    /**
     * @var string
     */
    protected static string $from;

    /**
     * @var string
     */
    protected static string $subject;

    /**
     * @var Email
     */
    protected static Email $email;

    /**
     * Setup all the parameters needed for sending an email
     *
     * @param Mailable $mailable
     * @return static
     * @throws Exception
     */
    public static function setup(Mailable $mailable)
    {
        self::$mailable = $mailable;

        $className = self::$mailable::class;

        if (!($email = Email::where('class', $className)->first())) {
            self::throwError($className . ' was not found on meto_emails.class');
        }

        self::$email = $email;

        self::$emailKey = $email->key;

        self::$recipients = json_decode($email->to);

        self::$cc = json_decode($email->cc);

        self::$from = $email->from ?: config('mail.from.address');

        self::$subject = $email->subject ?? $mailable->envelope()->subject;

        return new static();
    }

    /**
     * Define a subject for the email
     *
     * @param string $subject
     * @return $this
     */
    public function subject(string $subject)
    {
        self::$subject = $subject;

        return $this;
    }

    /**
     * Define a from address for the email
     *
     * @param string $from
     * @return $this
     */
    public function from(string $from)
    {
        self::$from = $from;

        return $this;
    }

    /**
     * Define a destination address(es) for the email
     *
     * @param string|array $recipients
     * @param bool $merge
     * @return $this
     */
    public function to(string|array $recipients, bool $merge = true)
    {
        if ($merge) {
            if (is_array($recipients)) {
                self::$recipients = array_merge(self::$recipients, $recipients);
            } else {
                self::$recipients []= $recipients;
            }
        } else {
            self::$recipients = is_array($recipients) ? $recipients : [$recipients];
        }

        return $this;
    }

    /**
     * Define cc addresses for the email
     *
     * @param string|array $cc
     * @param bool $merge
     * @return $this
     */
    public function cc(string|array $cc, bool $merge = true)
    {
        if ($merge) {
            if (is_array($cc)) {
                self::$cc = array_merge(self::$cc, $cc);
            } else {
                self::$cc []= $cc;
            }
        } else {
            self::$cc = is_array($cc) ? $cc : [$cc];
        }

        return $this;
    }

    /**
     * Execute sending the email
     *
     * @return SentMessage|null
     * @throws Exception
     */
    public function send()
    {
        self::setMailableAttributes();

        $this->checkIfAllFieldsAreFilled();

        return Mail::to(self::$recipients)
            ->send(self::$mailable);
    }

    /**
     * Apply all the attributes for the Mailable class
     *
     * @return void
     */
    protected static function setMailableAttributes()
    {
        $mailable = self::$mailable;

        $mailable->from(self::$from)
            ->to(self::$recipients);

        if (!empty(self::$cc)) {
            $mailable->cc(self::$cc);
        }

        $mailable->subject(self::$subject);
    }

    /**
     * Check if all the necessary fields exist
     * and throw an error if they don't
     *
     * @return void
     * @throws Exception
     */
    protected function checkIfAllFieldsAreFilled()
    {
        if (self::$recipients === '') self::throwError('No recipient email address was found.');

        if (self::$from === '') self::throwError('No from email address was found.');

        if (self::$subject === '') self::throwError('No subject was found.');
    }

    /**
     * Throws an error
     *
     * @param $message
     * @return mixed
     * @throws Exception
     */
    protected static function throwError($message)
    {
        throw new Exception($message);
    }
}
