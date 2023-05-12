<?php

namespace App\Services;

use App\Helpers;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UniService
{
    public static function getAdminData() :array
    {
        $universities = Helpers::dbQueryArray('
            select u.id, u.name, u.connections, e.name as "country"
            from meto_institutions as u
            left outer join meto_enum_countries as e on country = e.id;
        ');

        $counts = Helpers::dbQueryArray('
            select institution_id, count(institution_id) as match_count
			from meto_student_universities
            group by institution_id
        ');
        $countsToReturn = array();
        foreach ($counts as $count) {
            $countsToReturn[$count['institution_id']] = $count['match_count'];
        }

        return ['universities' => $universities, 'counts' => $countsToReturn];
    }

    public function getUsersForUni(int $uni_id): Collection
    {
        $ids = Helpers::dbQueryArray('
            select user_id from meto_user_institutions where institution_id = ' . $uni_id . ';
        ');
        return User::whereIn('id', array_column($ids, 'user_id'))->get();
   }

}
