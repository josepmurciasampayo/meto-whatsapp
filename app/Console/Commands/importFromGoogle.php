<?php

namespace App\Console\Commands;

use App\Imports\Answers;
use App\Imports\HighSchools;
use App\Imports\HistoricalStudents;
use App\Imports\Institutions;
use App\Imports\Matches;
use App\Imports\Questions;
use App\Imports\StudentHighSchools;
use App\Imports\Students;
use Database\Seeders\GoogleSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class importFromGoogle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:google';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to Google MySQL and import all updated data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (App::environment('local')) {
            $db = 'google-local';
        }
        if (App::environment('prod')) {
            $db = "google-prod";
        }

        try {
            Students::importFromGoogle($db);
        } catch(\Exception $exception) {
            Log::channel('import')->error('Error importing students: ' . $exception);
        }

        try {
            Institutions::importFromGoogle($db);
        } catch(\Exception $exception) {
            Log::channel('import')->error('Error importing institutions: ' . $exception);
        }

        try {
            Matches::importFromGoogle($db);
        } catch(\Exception $exception) {
            Log::channel('import')->error('Error importing matches: ' . $exception);
        }

        try {
            Answers::importFromGoogle($db);
        } catch(\Exception $exception) {
            Log::channel('import')->error('Error importing answers: ' . $exception);
        }

        try {
            HighSchools::importFromGoogle($db);
        } catch(\Exception $exception) {
            Log::channel('import')->error('Error importing high schools: ' . $exception);
        }

        try {
            StudentHighSchools::importFromGoogle();
        } catch(\Exception $exception) {
            Log::channel('import')->error('Error importing student/high schools: ' . $exception);
        }
    }
}
