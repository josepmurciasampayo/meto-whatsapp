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

    public Collection $counselors;

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

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = Mail::to($this->studentUniversity->student->user->email);

        if ($this->counselors) {
            $mail->cc($this->counselors->pluck('email'));
        }

        $mail->send(new ConnectionWasApproved($this->studentUniversity));
    }
}
