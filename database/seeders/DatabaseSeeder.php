<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            EnumSeeder::class,
            InstitutionSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            MatchSeeder::class,
            CampaignSeeder::class,
            ChatTestSeeder::class,
            UserRolesSeeder::class,
        ]);
    }
}
