<?php

namespace Database\Seeders;

use App\Enums\General\Form;
use App\Enums\User\Role;
use App\Http\Controllers\UserFormController;
use App\Imports\Answers;
use App\Imports\HighSchools;
use App\Imports\Institutions;
use App\Imports\Matches;
use App\Imports\Questions;
use App\Imports\Students;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleSeeder extends Seeder
{
    public function run($db = 'google-local') :void
    {
        DB::connection($db)->update('update students_table set imported = 0;');
        DB::connection($db)->update('update institutions_table set imported = 0;');
        DB::connection($db)->update('update inst_student_relationships set imported = 0;');
        DB::connection($db)->update('update answers_table set imported = 0;');

        echo "\n";
        Questions::importFromGoogle($db);
        echo "\nQuestions imported";
        Students::importFromGoogle($db);
        echo "\nStudents imported";
        Institutions::importFromGoogle($db);
        echo "\nInstitutions imported";
        Matches::importFromGoogle($db);
        echo "\nMatches imported";
        Answers::importFromGoogle($db);
        echo "\nAnswers imported";
        HighSchools::importFromGoogle($db);
        echo "\nHigh Schools imported";

        echo "\n\n";
        UserFormController::createForms(User::where('role', Role::STUDENT())->get(), Form::ENDOFCYCLE);
    }
}
