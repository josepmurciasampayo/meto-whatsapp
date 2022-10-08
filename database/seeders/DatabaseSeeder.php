<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(string $type = '')
    {
        $start = Carbon::now();

        $this->call([
            CountrySeeder::class,
            EnumSeeder::class,
            UserSeeder::class,
            CampaignSeeder::class,
            UserRolesSeeder::class,
            // ChatTestSeeder::class,
            GoogleSeeder::class,
        ]);

        $runTime = $start->diffInSeconds(Carbon::now());
        echo "\n\nTotal time for seeding: " . $runTime . " seconds";
    }
}
