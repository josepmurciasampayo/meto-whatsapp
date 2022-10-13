<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'address_1',
        'address_2',
        'city',
        'state',
        'postal_code',
        'country',
        'google_id',
    ];

    public static function getAdminData() :array
    {
        $universities = Helpers::dbQueryArray('
            select u.id, u.name, e.name as "country"
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
}
