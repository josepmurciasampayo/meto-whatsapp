<?php

namespace App\Console\Commands;

use App\Imports\Institutions;
use App\Imports\Matches;
use App\Imports\Students;
use Illuminate\Console\Command;

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
        Students::importStudentsFromGoogle();
        echo "\nStudents imported";
        Institutions::importInstitutionsFromGoogle();
        echo "\nInstitutions imported";
        Matches::importMatchesFromGoogle();
        echo "\nMatches imported";
    }
}
