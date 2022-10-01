<?php

namespace App\Models;

use App\Enums\General\Channel;
use App\Enums\User\Role;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class LogComms extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'channel',
        'from',
        'to',
        'body',
    ];

    public static function getAdminData() :array
    {
        return Helpers::dbQueryArray("
            select
                c.id as message_id,
                c.from,
                c.to,
                body,
                c.created_at,
                coalesce(user_to.id, user_from.id) as user_id,
                concat(coalesce(user_to.first, user_from.first), ' ', coalesce(user_to.last, user_from.last)) as 'name'
            from meto_log_comms as c
            left outer join meto_users as user_to on c.to = user_to.phone_combined and user_to.role = " . Role::STUDENT() . "
            left outer join meto_users as user_from on c.from = user_from.phone_combined and user_from.role = " . Role::STUDENT() . "
            where channel = " . Channel::WHATSAPP() . "
            order by c.created_at;
        ");
    }
}
