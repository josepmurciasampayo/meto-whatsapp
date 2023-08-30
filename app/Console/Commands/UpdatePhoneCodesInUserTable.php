<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdatePhoneCodesInUserTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-phone-codes-in-user-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates phone_code column on meto_users (gets values from enum_countries.country_code)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO: Waiting for Greg's answer
    }
}
