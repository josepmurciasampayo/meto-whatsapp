<?php

namespace Database\Seeders;

use App\Imports\Institutions;
use App\Imports\Matches;
use App\Imports\Students;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleSeeder extends Seeder
{
    public function run()
    {
        DB::connection('google')->update('
            update students_table set imported=0;
        ');
        DB::connection('google')->update('
            update institutions_table set imported=0;
        ');
        DB::connection('google')->update('
            update inst_student_relationships set imported=0;
        ');

        Students::importStudentsFromGoogle();
        Institutions::importInstitutionsFromGoogle();
        Matches::importMatchesFromGoogle();
    }
}
