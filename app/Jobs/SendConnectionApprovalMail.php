<?php

namespace App\Jobs;

use App\Mail\Connections\ConnectionWasApproved;
use App\Models\Connection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendConnectionApprovalMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Connection $studentUniversity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Connection $connection)
    {
        $this->studentUniversity = $connection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = Mail::to($this->studentUniversity->student->user->email);

        if ($counselors = $this->studentUniversity->student->user->highSchool->highSchool->counselors) {
            $mail->cc($counselors->pluck('email'));
        }

        $mail->send(new ConnectionWasApproved($this->studentUniversity));
    }
}
