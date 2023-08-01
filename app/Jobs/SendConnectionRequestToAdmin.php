<?php

namespace App\Jobs;

use App\Models\Student;
use App\Models\Connection;
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

    public $connections;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin, array $connections)
    {
        $this->admin = $admin;

        $this->connections = $connections;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Mail::to($this->admin)
            ->send(new SendConnectionRequestToAdminMail($this->connections));
    }
}
