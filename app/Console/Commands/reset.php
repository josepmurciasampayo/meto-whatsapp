<?php

namespace App\Console\Commands;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class reset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset app and database to specific testing purpose';

    /**
     * Dump the relevant tables, reload them with the chat test seeder, and restart the loop
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type');
        Artisan::call('migrate:fresh');

        $seeder = new DatabaseSeeder();
        $seeder->run($type);
    }
}
