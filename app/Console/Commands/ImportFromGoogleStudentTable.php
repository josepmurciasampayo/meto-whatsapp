<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportFromGoogleStudentTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-from-google-student-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
         * gender
         * dob
         * country_of_birth
         * city_of_birth
         * refugee_status
         * citizenships
         * disability_status
         * submission_device
         *
         */
    }
}
