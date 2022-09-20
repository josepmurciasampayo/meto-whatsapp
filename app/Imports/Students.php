<?php

namespace App\Imports;

use App\Enums\Student\Gender;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Students
{
    public static function importStudentsFromGoogle()
    {
        $query = '
            select * from students_table where imported = 0;
        ';
        $students = DB::connection('google')->select($query);
        foreach ($students as $student) {
            self::importStudent($student);
            self::markImported($student);
        }
        return 0;
    }

    private static function importStudent(\stdClass $studentDB) :void
    {
        /**
         * timestamp,
         * country_of_birth,
         * city_of_birth,
         * refugee_status,
         * citizenships,
         * family_in,
         * email_address_2,
         * email_owner,
         * phone_number,
         * phone_owner,
         * id_number,
         * passport_exp,
         * highest_edu_parents,
         * social_media_platform,
         * social_media_id,
         * disability_status,
         * submission_device,
         * actively_seeking_current_app_cycle,
         * curriculum
         **/

        $user = User::where('email', trim($studentDB->email_address_1))->first();
        if (!is_null($user)) {
            return;
        }

        $user = new User();
        $user->first = trim($studentDB->first_name);
        $user->last = trim($studentDB->last_name);
        $user->email = trim($studentDB->email_address_1);
        $user->role = Role::STUDENT();
        $user->status = Status::ACTIVE();
        $user->google_id = $studentDB->student_id;
        $user->save();

        $stu = new Student();
        $stu->user_id = $user->id;
        $stu->dob = $studentDB->dob;
        $stu->google_db_id = $studentDB->student_id;
        $stu->gender = match(strtolower($studentDB->gender)) {
            'male' => Gender::MALE(),
            'female' => Gender::FEMALE(),
            default => Gender::OTHER(),
            };
        $stu->save();
        }

        private static function markImported(\stdClass $student) :void
        {
            DB::connection('google')->update('
                update students_table set imported = 1 where student_id = ' . $student->student_id . ';
            ');
        }

        public static function countMatches(int $user_id) :int
        {
            $toReturn = DB::select('
                select count(*) as c
                from meto_users as u
                join meto_students as s on s.user_id = u.id
                join meto_match_student_institutions as m on m.student_id = s.id
                where u.id = ' . $user_id . '
            ');
            return $toReturn[0]->c;
        }
}
