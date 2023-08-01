<?php

namespace App\Services;

use App\Helpers;
use App\Models\Student;
use App\Models\User;
use App\Models\ViewStudentDetail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UniService
{
    public static function getAdminData() :array
    {
        $universities = Helpers::dbQueryArray('
            select i.id, i.name, i.connections, count(j.id) as user_count
            from meto_institutions as i
            left outer join meto_user_institutions as j on j.institution_id = i.id
            group by i.id;
        ');

        $counts = Helpers::dbQueryArray('
            select institution_id, count(institution_id) as match_count
			from meto_connections
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
