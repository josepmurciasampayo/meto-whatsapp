<?php

namespace App\Imports;

use App\Enums\Chat\Campaign;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Helpers;
use App\Models\Chat\MessageState;
use App\Models\Institution;
use App\Models\MatchStudentInstitution;
use App\Models\Student;
use App\Models\User;

class HistoricalStudents
{
    public static function importFromCSV() :void
    {
        $students = Helpers::arrayFromCSV(database_path('seeders/historicalmatches.csv'));
        foreach ($students as $studentCSV) {
            // make sure we have a student record
            $student = self::processStudent($studentCSV);

            // make sure we have a university record
            $colleges = explode(",", $studentCSV['commaseparated']);
            foreach ($colleges as $college) {
                if ($college == '') {
                    continue;
                }
                $institution = Institution::where('name', $college)->first();
                if (is_null($institution)) {
                    $institution = self::createInstitution($college);
                }

                // create the join record
                $match = new MatchStudentInstitution();
                $match->student_id = $student->id;
                $match->institution_id = $institution->id;
                $match->status = \App\Enums\General\MatchStudentInstitution::UNKNOWN();
                $match->save();

            }
        }

        $students = Helpers::arrayFromCSV(database_path('seeders/studentsforbot.csv'));
        foreach ($students as $studentCSV) {
            $student = self::processStudent($studentCSV);
            MessageState::queueCampaign($student->user_id, Campaign::ENDOFCYCLE);
        }
    }

    public static function processStudent(array $studentCSV) :Student
    {
        $student = null;
        if ($studentCSV['student_id']) { // go with google ID if it exists
            $student = Student::where('google_id', $studentCSV['student_id'])->first();
            if (is_null($student)) {
                $student = self::createUserAndStudent($studentCSV);
            }
        } else {
            $user = User::where('email', $studentCSV['email'])->first(); // then check email
            if (is_null($user)) {
                $student = self::createUserAndStudent($studentCSV);
            } else {
                $student = Student::where('user_id', $user->id);
                return $student->first();
            }
        }
        return $student;
    }

    public static function createUserAndStudent(array $userCSV) :Student
    {
        $user = new User();
        $user->first = $userCSV['first'];
        $user->last = $userCSV['last'];
        $user->email = $userCSV['email'];
        if (isset($userCSV['numbers'])) {
            $user->phone_raw = $userCSV['numbers'];
            $user->phone_combined = Helpers::stripNonNumeric($userCSV['numbers']);
        }
        $user->role = Role::STUDENT();
        $user->status = Status::ACTIVE();
        $user->save();

        return self::createStudent($user);
    }

    public static function createStudent(User $user) :Student
    {
        $student = new Student();
        $student->user_id = $user->id;
        $student->save();
        return $student;
    }

    public static function createInstitution(string $name) :Institution
    {
        $institution = new Institution();
        $institution->name = $name;
        $institution->save();
        return $institution;
    }
}
