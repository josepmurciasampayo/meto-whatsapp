<?php

namespace App\Jobs;

use App\Mail\Connections\ConnectionWasApproved;
use App\Models\Connection;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendConnectionApprovalMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Connection $studentUniversity;

    public ?Collection $counselors;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Connection $connection, ?Collection $counselors)
    {
        $this->studentUniversity = $connection;

        $this->counselors = $counselors;
    }

    public function handle()
    {
        $validator = new EmailValidator();
        $email = $this->studentUniversity->student->user->email;

        if ($validator->isValid($email, new RFCValidation())) {
            $mail = Mail::to($email);

            if ($this->counselors) {
                $emails = $this->counselors->pluck('email');

                $ccEmails = ($this->studentUniversity->cc_emails) ? explode(',', $this->studentUniversity->cc_emails) : null;
                if ($ccEmails) {
                    foreach ($ccEmails as $email) {
                        if ($validator->isValid($email, new RFCValidation())) {
                            $emails[] = $email;
                        }
                    }
                }

                $emails[] = $this->studentUniversity->requester?->email;

                $mail->cc($emails);
            }

            $mail->send(new ConnectionWasApproved($this->studentUniversity));
        }
    }
}
