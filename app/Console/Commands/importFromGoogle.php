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
    protected $signature = 'command:importFromGoogle';

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
        Institutions::importInstitutionsFromGoogle();
        Matches::importMatchesFromGoogle();
    }
}
