<?php

namespace App\Models;

use App\Enums\EnumGroup;
use App\Enums\General\LoginEventType;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoginEvents extends Model
{
    public $timestamps = false;

    public static function getAdminData() :array
    {
        return Helpers::dbQueryArray('
            select
            u.email,
            r.enum_desc as "role",
            concat(u.first, " ", u.last) as "name",
            t.enum_desc as "type",
            e.event_time
            from meto_login_events as e
            join meto_users as u on u.id = e.user_id
            join meto_enum as r on r.group_id = ' . EnumGroup::USER_ROLE() . ' and r.enum_id = u.role
            join meto_enum as t on t.group_id = ' . EnumGroup::GENERAL_LOGINEVENTTYPE() . ' and t.enum_id = e.type
        ');
    }

    public static function getLatestLogins() :array
    {
        return Helpers::dbQueryArray('
            select
                u.email,
                r.enum_desc as "role",
                concat(u.first, " ", u.last) as "name",
                e.event_time
            from meto_login_events as e
            join meto_users as u on u.id = e.user_id
            join meto_enum as r on r.group_id = ' . EnumGroup::USER_ROLE() . ' and r.enum_id = u.role
        ');
    }

    public static function clearLatest(int $user_id, LoginEventType $type) :void
    {
        Helpers::dbUpdate('
            update meto_login_events
            set latest = 0
            where user_id = ' . $user_id . ' and type = ' . $type() . ';
        ');
    }
}
