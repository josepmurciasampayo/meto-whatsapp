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

        Students::importFromGoogle($db);
        Institutions::importFromGoogle($db);
        Matches::importFromGoogle($db);
        Answers::importFromGoogle($db);
        HighSchools::importFromGoogle($db);
        StudentHighSchools::importFromGoogle($db);
    }
}
