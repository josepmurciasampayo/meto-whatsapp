<?php

namespace App\Models;

use App\Enums\User\Role;
use App\Enums\HighSchool\Role as HSRole;
use App\Helpers;
use App\Models\Joins\UserHighSchool;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Model;

class HighSchool extends Model
{
    public $guarded = [];

    public function admin()
    {
        return $this->hasOneThrough(
            User::class,
            UserHighSchool::class,
            'highschool_id',
            'id',
            'id',
            'user_id'
        )->where('user_high_schools.role', HSRole::ADMIN);
    }

    public function students()
    {
        return $this->hasManyThrough(
            User::class,
            UserHighSchool::class,
            'highschool_id',
            'id',
            'id',
            'user_id'
        )->where('user_high_schools.role', HSRole::STUDENT);
    }

    public function counselors()
    {
        // TODO: separate admin from counselors and make sure we modify that in the cc too
        /*
        $ids = UserHighSchool::where('highschool_id', $this->id)->whereIn('role', [HSRole::ADMIN(), HSRole::COUNSELOR()])->pluck('user_id');
        return User::find($ids);
        */
        return $this->hasManyThrough(
            User::class,
            UserHighSchool::class,
            'highschool_id',
            'id',
            'id',
            'user_id'
        )->whereIn('user_high_schools.role', [HSRole::ADMIN(), HSRole::COUNSELOR()]);
    }

    public static function getByCounselorID(int $user_id): ?HighSchool
    {
        $join = UserHighSchool::where('user_id', $user_id)->first();
        if ($join) {
            return HighSchool::find($join->highschool_id);
        }

        return null;
    }

    public static function getByName(string $name): ?HighSchool
    {
        return HighSchool::where('name', $name)->first();
    }

    public static function searchByName(string $name)
    {
        return HighSchool::where('name', 'LIKE', '%' . $name . '%')->get();
    }

    public static function getByStudentID(int $student_id): ?HighSchool
    {
        $user = Student::find($student_id)->user;
        $join = UserHighSchool::where('user_id', $user->id)->first();
        if ($join) {
            return HighSchool::find($join->highschool_id);
        }
        return null;
    }

    public static function isStudentEnrolled(int $student_id, int $highschool_id): bool
    {
        return UserHighSchool::where('user_id', $student_id)->where('highschool_id', $highschool_id)->count() > 0;
    }
}
