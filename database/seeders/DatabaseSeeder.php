<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Message;
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
            ChatSeeder::class,
            ChatTestSeeder::class,
        ]);
    }
}
