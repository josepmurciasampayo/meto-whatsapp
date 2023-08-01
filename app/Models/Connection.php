<?php

namespace App\Models;

use App\Console\Commands\reloadEnums;
use App\Enums\EnumGroup;
use Illuminate\Database\Eloquent\Model;
use App\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Connection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getByUserID(int $user_id) :array
    {
        return Helpers::dbQueryArray('
            select
                matches.id as match_id,
                user_id,
                student_id,
                institution_id,
                matches.status as status_id,
                match_status.enum_desc as "status",
                first,
                last,
                name
            from meto_connections as matches
            join meto_students as students on matches.student_id = students.id
            join meto_users as users on students.user_id = users.id
            join meto_institutions as institutions on matches.institution_id = institutions.id
            join meto_enum as match_status on match_status.group_id = ' . EnumGroup::GENERAL_MATCH()  . ' and match_status.enum_id = matches.status
            where users.id = ' . $user_id . ';
        ');
    }

    public static function updateMatchStatusByMatchID(int $match_id, int $status, int $user_id = null) :void
    {
        if (is_null($user_id)) { // run by system/admin/counselor
            Helpers::dbUpdate('
                update meto_connections
                set status = ' . $status . '
                where id = ' . $match_id . ';
            ');
            return;
        }

        Helpers::dbUpdate('
            update meto_connections as m
            join meto_students as s on s.user_id = ' . $user_id .'
            set status = ' . $status . '
            where m.id = ' . $match_id . '
            and student_id = s.id;
        ');
    }
}
