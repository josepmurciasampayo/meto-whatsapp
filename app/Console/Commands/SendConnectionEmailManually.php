<?php

namespace App\Console\Commands;

use App\Enums\General\MatchStudentInstitution;
use App\Jobs\SendConnectionApprovalMail;
use App\Models\Connection;
use Illuminate\Console\Command;

class SendConnectionEmailManually extends Command
{
    protected $signature = 'app:send-connection-email-manually';

    protected $description = 'Command description';

    public function handle()
    {
        $aug25 = Connection::with('student', 'institution')
            ->where('status', MatchStudentInstitution::ACCEPTED())
            ->whereDate('updated_at', '2023-08-25')
            ->get();

        $colgate = Connection::with('student', 'institution')
            ->where('status', MatchStudentInstitution::ACCEPTED())
            ->where('institution_id', 25)
            ->get();

        $all = $aug25->merge($colgate);

        foreach ($all as $connection) {
            $highschool = $connection->student->user->highSchool;
            $counselors = $highschool?->counselors;

            SendConnectionApprovalMail::dispatch($connection, $counselors);
        }
    }
}
