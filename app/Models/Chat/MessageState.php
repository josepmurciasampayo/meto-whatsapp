<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MessageState extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message_id',
        'state',
        'response',
        'last_changed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'last_changed' => 'datetime',
    ];

    public static function getMessagesToSend() :array
    {
        $toReturn = DB::select('');
        return $toReturn;
    }

    public static function getState(string $fromNumber) :array
    {
        return DB::select('
                select
                    users.id as user_id,
                    users.first as first,
                    users.last as last,
                    users.email as email,
                    messages.id as message_id,
                    messages.text as text,
                    messages.capture_filter,
                    messages.answer_table,
                    messages.answer_field,
                    messages.branch_id,
                    branches.response,
                    branches.to_message_id,
                    message_states.id as state_id,
                    message_states.state as state
                from ' . (new User)->getTable() . ' as users
                join message_states as message_states on message_states.user_id = users.id
                join messages as messages on message_states.message_id = messages.id
                join branches as branches on branches.from_message_id = messages.id
                where users.phone = "' . $fromNumber . '";
            ');
    }

    public static function updateMessageState($user_id, $message_id, $state) :void
    {
        DB::update('
            set
        ');
    }
}
