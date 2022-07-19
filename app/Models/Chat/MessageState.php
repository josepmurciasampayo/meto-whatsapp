<?php

namespace App\Models\Chat;

use App\Enums\Chat\Chat;
use App\Enums\User\{Consent, Verified};
use App\Enums\Chat\State;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class MessageState extends Model
{
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * @param int $user_id
     * @param Chat $message
     */
    public static function startMessage(int $user_id, int $message_id) :void
    {
        Log::channel('chat')->debug("Queueing chat " . $message_id . " for user " . $user_id);
        DB::insert("
            insert into meto_message_states
            (user_id, message_id, state)
            values (" . $user_id .", " . $message_id . ", " . State::QUEUED() .");
        ");
    }

    /**
     * @return array
     */
    public static function getNewMessagesToSend() :array
    {
        $toReturn = Helpers::dbQueryArray('
            select
            user.id as user_id,
            min(message_state.id) as message_state_id,
            message.text as text,
            user.first as first,
            user.phone_country,
            user.phone_area,
            user.phone_local
            from meto_users as user
            join meto_message_states as message_state on message_state.user_id = user.id
            join meto_messages as message on message.id = message_id
            where message_state.state = ' . State::QUEUED() . '
            group by user.id
        ');
        return $toReturn;
    }

    /**
     * Remove users who denied permission and asks permission for users who haven't been
     * @param array $userIDs
     * @return array of user_ids to not send message to
     */
    public static function preMessageChecks(array $userIDs) :array
    {
        $toRemove = array();

        $toCheck = Helpers::dbQueryArray('
            select
            users.id as user_id,
            users.phone_verified,
            users.whatsapp_consent
            from meto_users as users
            where id in (' . implode(",", $userIDs, ) . ');
        ');

        foreach ($toCheck as $student) {
            if ($student['phone_verified'] == Verified::DENIED() or $student['whatsapp_consent'] == Consent::NOCONSENT()) {
                $toRemove[] = $student['user_id'];
                Log::channel('chat')->debug('Removed ' . $student['user_id']);
                continue;
            }
            if ($student['phone_verified'] == Verified::UNKNOWN()) {
                self::startMessage($student['user_id'], Chat::CONFIRMIDENTITY());
                Log::channel('chat')->debug('Added user to verify identity: ' . $student['user_id']);
            }
            if ($student['whatsapp_consent'] == Consent::UNKNOWN()) {
                self::startMessage($student['user_id'], Chat::CONFIRMPERMISSION());
                Log::channel('chat')->debug('Added user to confirm permission: ' . $student['user_id']);
            }
        }

        return $toRemove;
    }

    /**
     * @return array
     */
    public static function getEndOfApplicationCycles() :array
    {
        // get list of users with queued status of messages
        $toReturn = Helpers::dbQueryArray('
            select
            users.id as user_id
            from meto_users as users
            join meto_message_states as message_states on message_states.user_id = users.id
            join meto_messages as messages on message_states.message_id = messages.id
            where message_states.state = ' . State::QUEUED() . '
            and message_states.message_id = ' . Chat::ENDOFCYCLE() . ';
        ');

        $toRemove = self::preMessageChecks(array_column($toReturn, 'user_id'));
        $toReturn = Helpers::removeElementsInArray($toReturn, $toRemove, 'user_id');
        return $toReturn;
    }

    /**
     * @param int $user_id
     * @return array
     */
    public static function getState(int $user_id) :array
    {
        return Helpers::dbQueryArray('
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
                from meto_users as users
                join meto_message_states as message_states on message_states.user_id = users.id
                join meto_messages as messages on message_states.message_id = messages.id
                join meto_branches as branches on branches.from_message_id = messages.id
                where users.id = ' . $user_id . '
                and message_states.state in (' . implode(",", [State::SENT()]) . ')
                order by message_states.message asc;
            ');
    }

    /**
     * @param $user_id
     * @param $message_id
     * @param $state
     */
    public static function updateMessageState(int $user_id, int $message_id, State $state) :void
    {
        DB::update("
            update meto_message_states set state = " . $state() . "
            where user_id = " . $user_id . " and message_id = " . $message_id . ";
        ");
    }


}
