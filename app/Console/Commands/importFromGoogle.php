<?php

namespace App\Console\Commands;

use App\Imports\Answers;
use App\Imports\HistoricalStudents;
use App\Imports\Institutions;
use App\Imports\Matches;
use App\Imports\Students;
use Database\Seeders\GoogleSeeder;
use Illuminate\Console\Command;
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
    protected $description = 'Connect to Google MySQL and import all relevant data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $db = "google-local";

        //$seeder = new GoogleSeeder();
        //$seeder->run($db);

        HistoricalStudents::importFromCSV();
    }
}
