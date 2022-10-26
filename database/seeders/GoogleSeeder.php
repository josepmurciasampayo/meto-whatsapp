<?php

namespace Database\Seeders;

use App\Enums\General\Form;
use App\Enums\User\Role;
use App\Http\Controllers\UserFormController;
use App\Imports\Answers;
use App\Imports\HighSchools;
use App\Imports\HistoricalStudents;
use App\Imports\Institutions;
use App\Imports\Matches;
use App\Imports\Questions;
use App\Imports\StudentHighSchools;
use App\Imports\Students;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class GoogleSeeder extends Seeder
{
    public function run($db = 'google-local') :void
    {
        if (App::environment('prod')) {
            $db = 'google-prod';
        } else {
            DB::connection($db)->update('update students_table set imported = 0;');
            DB::connection($db)->update('update institutions_table set imported = 0;');
            DB::connection($db)->update('update inst_student_relationships set imported = 0;');
            DB::connection($db)->update('update answers_table set imported = 0;');
            DB::connection($db)->update('update counselors_table set imported = 0;');
            DB::connection($db)->update('update additional_student_affiliated_orgs set imported = 0;');
        }

        Questions::importFromGoogle($db);
        echo "\nQuestions imported\n";

        Students::importFromGoogle($db);
        echo "\nStudents imported\n";

        Institutions::importFromGoogle($db);
        echo "\nInstitutions imported\n";

        Matches::importFromGoogle($db);
        echo "\nMatches imported\n";

        Answers::importFromGoogle($db);
        echo "\nAnswers imported\n";

        HighSchools::importFromGoogle($db);
        echo "\nHigh Schools imported\n";

        StudentHighSchools::importFromGoogle($db);
        echo "\nStudents associated with high schools\n";

        return;
        self::associateExistingCounselors();

        HistoricalStudents::importFromCSV();
        echo "\nHistorical students and matches imported\n";

        echo "\n\n";
        UserFormController::createForms(User::where('role', Role::STUDENT())->get(), Form::ENDOFCYCLE);
    }

    private static function associateExistingCounselors() :void
    {
        /*
         *  jeninah12@gmail.com	Cornerstone Leadership Academy, Rwanda
            counselor@maranyundogirlsschool.org	Maranyundo Girls School
            lucinda.ochieng@agakhanacademies.org	The Aga Khan Academy Mombasa
         */

        $user = User::getByEmail('jeninah12@gmail.com');
        $hs = HighSchool::getByName('Cornerstone Leadership Academy, Rwanda');
        $join = new UserHighSchool();
        $join->user_id = $user->id;
        $join->highschool_id = $hs->id;
        $join->save();

        $user = User::getByEmail('counselor@maranyundogirlsschool.org');
        $user->title = "Director of College and Career Counseling";
        $user->password = '$2y$10$eqssId9qDJXIZfR3aCUgiOu33gSdtgxxW8QwUgetbYtLacXFUlA5y';
        $user->save();

        $user = User::getByEmail('lucinda.ochieng@agakhanacademies.org');
        $user->title = "University Counselor";
        $user->password = '$2y$10$1atdp/n36j1ZBd60rNEjheh0ltEX3VtY.5mSja1MKmUZ29Y6sxgTK';
        $user->save();

    }
}
