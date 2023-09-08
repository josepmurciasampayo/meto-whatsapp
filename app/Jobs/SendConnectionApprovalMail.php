<?php

namespace App\Jobs;

use App\Mail\Connections\ConnectionWasApproved;
use App\Models\Connection;
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

        $mail = Mail::to($this->studentUniversity->student->user->email);

        if ($this->counselors) {
            $emails = $this->counselors->pluck('email');

            $ccEmails = ($this->studentUniversity->cc_emails) ? explode(',', $this->studentUniversity->cc_emails) : null;
            if ($ccEmails) {
                foreach ($ccEmails as $email) {
                    $emails[] = $email;
                }
            }

            $emails[] = $this->studentUniversity->requester?->email;

            $mail->cc($emails);
        }

        $mail->send(new ConnectionWasApproved($this->studentUniversity));
    }
}
