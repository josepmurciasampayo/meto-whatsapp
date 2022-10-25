<?php

namespace App\Console\Commands;

use Database\Seeders\EnumSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class reloadEnums extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reload:enums';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncates enum table and reloads it';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('enum')->truncate();

        $seeder = new EnumSeeder();
        $seeder->run();

        return Command::SUCCESS;
    }
}
