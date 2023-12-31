<?php

namespace App\Jobs;

use App\Mail\Connections\ConnectionWasDenied;
use App\Models\Connection;
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
    public function __construct(Connection $connection)
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
        Mail::to($this->studentUniConnection->requester)
            ->send(new ConnectionWasDenied($this->studentUniConnection));
    }
}
