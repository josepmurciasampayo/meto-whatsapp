<?php

namespace Database\Seeders;

use App\Enums\Institution\Type;
use App\Helpers;
use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institutions = Helpers::arrayFromCSV(database_path('seeders/institutions.csv'));
        foreach ($institutions as $institution) {
            $type = match($institution['type']) {
                'Scholarship or access program' => Type::SCHOLARSHIP,
                'University or college that awards bachelor\'s degrees' => Type::UNIVERSITY,
                'Vocational or skills-based program' => Type::VOCATIONAL,
            };
            Institution::create([
                'name' => $institution['name'],
                'type' => $type,
                'country' => $institution['country'],
            ]);

        }
    }
}
