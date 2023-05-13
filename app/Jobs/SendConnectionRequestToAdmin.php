<?php

namespace App\Jobs;

use App\Models\Student;
use App\Models\StudentUniversity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendConnectionRequestToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admin;

    public $student;

    public $connection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin, Student $student, StudentUniversity $connection)
    {
        $this->admin = $admin;

        $this->student = $student;

        $this->connection = $connection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Mail::to($this->admin)
            ->send(new \App\Mail\SendConnectionRequestToAdmin($this->student, $this->connection));
    }
}
