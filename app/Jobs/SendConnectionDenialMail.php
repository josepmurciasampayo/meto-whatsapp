<?php

namespace App\Jobs;

use App\Mail\Connections\ConnectionWasDenied;
use App\Models\StudentUniversity;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendConnectionDenialMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $studentUniConnection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(StudentUniversity $connection)
    {
        $this->studentUniConnection = $connection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $connection = $this->studentUniConnection;

        $uniUsers = $connection->institution->users->pluck('id');

        $users = User::query()
            ->whereIn('id', $uniUsers)
            ->get();

        Mail::to($users)
            ->send(new ConnectionWasDenied($connection));
    }
}
