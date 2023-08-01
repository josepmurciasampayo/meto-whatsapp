<?php

namespace App\Models;

use App\Enums\User\Role;
use App\Helpers;
use App\Models\Joins\UserHighSchool;
use \Illuminate\Database\Eloquent\Model;

class HighSchool extends Model
{
    public static function getAdminData(int $id = null): array
    {
        $where = ($id) ? " where h.id = " . $id : '';
        $withCounselors = Helpers::dbQueryArray('
            select
                h.id, h.name, h.verified, h.curriculum, h.country, h.city, h.type, count(*) as "students"
            from meto_high_schools as h
            join meto_user_high_schools as c on h.id = c.highschool_id
            ' . $where . '
            group by c.highschool_id
        ');
        if ($id) {
            return $withCounselors[0];
        }
        return $withCounselors;
    }

    public static function getByCounselorID(int $user_id): HighSchool
    {
        $id = Helpers::dbQueryArray('
            select h.id
            from meto_high_schools as h
            join meto_user_high_schools as j on j.user_id = ' . $user_id . ' and j.highschool_id = h.id
        ')[0]['id'];

        return HighSchool::find($id);
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
        $row = Helpers::dbQueryArray('
            select
                   u.id as user_id,
                   s.id as student_id,
                   h.id as highschool_id
            from meto_users as u
            join meto_students as s on s.user_id = u.id
            join meto_user_high_schools as j on j.user_id = u.id
            join meto_high_schools as h on h.id = j.highschool_id
            where s.id = ' . $student_id . ';
        ');
        if ($row) {
            $id = $row[0]['highschool_id'];
            return HighSchool::find($id);
        }
        return null;
    }

    public static function isStudentEnrolled(int $student_id, int $highschool_id): bool
    {
        $row =  Helpers::dbQueryArray('
        select s.id
        from meto_students as s
        join meto_users as u on s.user_id = u.id
        join meto_user_high_schools as j on j.user_id = u.id and j.highschool_id = ' . $highschool_id . '
        where s.id = ' . $student_id . ';
        ');
        return count($row) > 0;
    }

    public static function getSummaryCounts(int $school_id): array
    {
        return Helpers::dbQueryArray('
            select sum(active) as "active", count(*) as "total"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_user_high_schools as m on m.user_id = u.id and m.highschool_id = ' . $school_id . '
            ;
        ')[0];
    }

    public function counselors()
    {
        return $this->hasManyThrough(
            User::class,
            UserHighSchool::class,
            'highschool_id',
            'id'
        )->whereIn('users.role', [Role::ADMIN, Role::COUNSELOR]);
    }
}
