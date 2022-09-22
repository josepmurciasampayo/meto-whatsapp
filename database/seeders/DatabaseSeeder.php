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
    public function run(string $type = '')
    {
        $this->call([
            CountrySeeder::class,
            EnumSeeder::class,
            UserSeeder::class,
            CampaignSeeder::class,
            UserRolesSeeder::class,
            ChatTestSeeder::class,
            InstitutionSeeder::class,
        ]);

        if ($type == 'google') {
            $this->call([
                GoogleSeeder::class,
            ]);
        }

    }
}
