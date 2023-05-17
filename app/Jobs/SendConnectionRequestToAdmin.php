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
use App\Mail\SendConnectionRequestToAdmin as SendConnectionRequestToAdminMail;

class SendConnectionRequestToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admin;

    public $student;

    public $createdConnection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin, Student $student, StudentUniversity $createdConnection)
    {
        $this->admin = $admin;

        $this->student = $student;

        $this->createdConnection = $createdConnection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Mail::to($this->admin)
            ->send(new SendConnectionRequestToAdminMail($this->student, $this->createdConnection));
    }
}
