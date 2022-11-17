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
        $from = Helpers::dbQueryArray("
            select
                c.id as message_id,
                c.from,
                c.to,
                body,
                c.created_at,
                user.id as user_id,
                concat(first, ' ', last) as 'name'
            from meto_log_comms as c
            join meto_users as user on c.to = user.phone_combined and user.role = " . Role::STUDENT() . " and c.to != 'METO'
            where channel = " . Channel::WHATSAPP() . "
            order by c.created_at;
        ");

        $to = Helpers::dbQueryArray("
            select
                c.id as message_id,
                c.from,
                c.to,
                body,
                c.created_at,
                user.id as user_id,
                concat(first, ' ', last) as 'name'
            from meto_log_comms as c
            join meto_users as user on c.from = user.phone_combined and user.role = " . Role::STUDENT() . " and c.from != 'METO'
            where channel = " . Channel::WHATSAPP() . "
            order by c.created_at;
        ");

        $toReturn = $to + $from;
        return $toReturn;
    }
}
