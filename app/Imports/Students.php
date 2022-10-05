<?php

namespace App\Imports;

use App\Enums\Country\Country;
use App\Enums\Student\Curriculum;
use App\Enums\Student\Gender;
use App\Enums\Student\Owner;
use App\Enums\Student\Refugee;
use App\Enums\Student\TagsStudent;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Helpers;
use App\Models\Student;
use App\Models\StudentTag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Students
{
    public static function importFromGoogle(string $db) :int
    {
        $query = '
            select * from students_table where imported = 0;
        ';
        $students = DB::connection($db)->select($query);
        foreach ($students as $student) {
            self::importStudent($student);
            self::markImported($student, $db);
        }
        return 1;
    }

    private static function importStudent(\stdClass $studentDB) :void
    {
        /**
         * email_address_2,
         * email_owner,
         * id_number,
         * passport_exp,
         * highest_edu_parents,
         * social_media_platform,
         * social_media_id,
         * submission_device,
         * actively_seeking_current_app_cycle,
         * curriculum
         **/

        $user = User::where('email', trim($studentDB->email_address_1))->first();
        if (!is_null($user)) {
            return;
        }

        $user = new User();
        $user->created_at = $studentDB->timestamp;
        $user->first = trim($studentDB->first_name);
        $user->last = trim($studentDB->last_name);
        $user->email = trim($studentDB->email_address_1);
        $user->role = Role::STUDENT();
        $user->status = Status::ACTIVE();
        $user->google_id = $studentDB->student_id;
        $user->phone_combined = Helpers::stripNonNumeric($studentDB->phone_number);
        $user->phone_raw = $studentDB->phone_number;
        switch($studentDB->phone_owner) {
            case '':
                break;
            case 'My dad':
                $user->phone_owner = Owner::DAD();
                break;
            case 'My mom':
                $user->phone_owner = Owner::MOM();
                break;
            case 'My brother or sister':
                $user->phone_owner = Owner::SIBLING();
                break;
            case 'Other':
            default:
                $user->phone_owner = Owner::OTHER();
                break;
        }

        $user->save();

        $stu = new Student();
        $stu->user_id = $user->id;
        $stu->dob = $studentDB->dob;
        $stu->google_id = $studentDB->student_id;
        $stu->curriculum = match($studentDB->curriculum) {
            'all_other' => Curriculum::OTHER(),
            'american' => Curriculum::AMERICAN(),
            'cambridge' => Curriculum::CAMBRIDGE(),
            'ib' => Curriculum::IB(),
            'kenyan' => Curriculum::KENYAN(),
            'rwandan' => Curriculum::RWANDAN(),
            'ugandan' => Curriculum::UGANDAN(),
            'uni_transfer' => Curriculum::TRANSFER(),
        };
        $stu->birth_country = Country::lookup($studentDB->country_of_birth);
        $stu->birth_city = $studentDB->city_of_birth;
        $stu->refugee = ($studentDB->refugee_status == 'Yes') ? Refugee::YES() : Refugee::NO();
        $stu->disability_raw = $studentDB->disability_status;

        $citizenships = explode(",", $studentDB->citizenships);
        foreach ($citizenships as $citizenship) {
            $tag = new StudentTag();
            $tag->type = TagsStudent::CITIZENSHIPS();
            $tag->data_int = Country::lookup($citizenship);
        }

        $family_in = explode(",", $studentDB->citizenships);
        foreach ($family_in as $country) {
            $tag = new StudentTag();
            $tag->type = TagsStudent::COUNTRYFAMILY();
            $tag->data_int = Country::lookup($country);
        }

        $stu->gender = match(strtolower($studentDB->gender)) {
            'male' => Gender::MALE(),
            'female' => Gender::FEMALE(),
            'other / prefer not to say' => Gender::OTHER(),
            };

        $stu->save();
    }

    private static function markImported(\stdClass $student, string $db) :void
    {
        DB::connection($db)->update('
            update students_table set imported = 1 where student_id = ' . $student->student_id . ';
        ');
    }
}
