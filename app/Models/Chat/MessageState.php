<?php

namespace App\Models\Chat;

use App\Enums\Chat\Campaign;
use App\Enums\User\{Consent, Role, Verified};
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
        'priority',
        'state',
        'response',
    ];

    /**
     * @param int $user_id
     * @param Campaign $message
     */
    public static function queueCampaign(int $user_id, Campaign $campaign, int $priority = 3) :void
    {
        $message_id = Message::getIDfromCampaign($campaign);
        self::queueMessage($user_id, $message_id, $priority);
    }

    /**
     * @param int $user_id
     * @param int $message_id
     * @param int $priority
     */
    public static function queueMessage(int $user_id, int $message_id, int $priority = 3) :void
    {
        Log::channel('chat')->debug("Queueing message " . $message_id . " for user " . $user_id);
        $existing = Helpers::dbQueryArray('
            select
            id
            from meto_message_states
            where user_id = ' . $user_id .' and message_id = ' . $message_id .'
                and state in (' . implode(",", [State::QUEUED(), State::WAITING(), State::ERROR()]) . ');
        ');

        if (count($existing) == 0) {
            DB::insert("
                insert into meto_message_states
                (user_id, message_id, priority, state, created_at)
                values (" . $user_id .", " . $message_id . ", " . $priority . ", " . State::QUEUED() .", now());
            ");
        }
    }

    /**
     * @return array
     */
    public static function getQueuedMessagesToSend() :array
    {
        // identify queued messages that need verifications or confirmations before sending
        // verifications and confirmations get loaded with higher priorities than campaigns
        self::queueVerifications();
        self::queueConfirmations();

        // do not queue new messages for users who we are waiting on responses for
        $waitingUsers = Helpers::dbQueryArray("
            select user_id from meto_message_states where state = ". State::WAITING() . "
        ");

        // TODO: fix all this in SQL
        echo "Count: " . count($waitingUsers);
        $waitingUsersClause = (count($waitingUsers) > 0) ? ' and user.id not in (' . implode(",", $waitingUsers) . ') ' : '';

        // find all messages that are queued for each user not excluded above
        $allMessages = Helpers::dbQueryArray('
            select
            user.id as user_id,
            user.first as first,
            user.phone_combined as phone,
            message_id,
            state.id as state_id,
            priority,
            text,
            if(capture_filter is null, false, true) as wait_for_reply
            from meto_users as user
            join meto_message_states as state on state.user_id = user.id
            join meto_messages as message on state.message_id = message.id
            where user.role = ' . Role::STUDENT() . '
            and user.phone_verified != ' . Verified::DENIED() . '
            and user.whatsapp_consent != ' . Consent::NOCONSENT() .
            $waitingUsersClause . ';
        ');

        Log::channel('chat')->debug('All messages found: ' . print_r($allMessages, true));

        // Look through each message, save one per user, replace if there's one with a lower priority
        $toReturn = array();
        foreach ($allMessages as $message) {
            $user_id = $message['user_id'];
            if (!key_exists($user_id, $toReturn)) {
                $toReturn[$user_id] = $message;
            } else {
                if ($message['priority'] < $toReturn[$user_id]['priority']) {
                    $toReturn[$user_id] = $message;
                }
            }
        }

        Log::channel('chat')->debug('Messages returned: ' . print_r($toReturn, true));

        return $toReturn;
    }

    /**
     * Find all users with a queued message of any type that also have an unknown Whatsapp consent status
     */
    public static function queueConfirmations() :void
    {
        $toReturn = Helpers::dbQueryArray('
            select
            distinct user.id as user_id
            from meto_users as user
            join meto_message_states as message_state on message_state.user_id = user.id
            where message_state.state = ' . State::QUEUED() . '
            and user.role = ' . Role::STUDENT() . '
            and user.whatsapp_consent = ' . Consent::UNKNOWN() . '
        ');

        foreach ($toReturn as $student) {
            self::queueCampaign($student['user_id'], Campaign::CONFIRMPERMISSION, 2);
            Log::channel('chat')->debug('Added user to confirm permission: ' . $student['user_id']);
        }
    }

    /**
     * Fina all users with a queued message of any type that also have an unknown identity verification status
     */
    public static function queueVerifications() :void
    {
        $toReturn = Helpers::dbQueryArray('
            select
            distinct user.id as user_id
            from meto_users as user
            join meto_message_states as message_state on message_state.user_id = user.id
            where message_state.state = ' . State::QUEUED() . '
            and user.role = ' . Role::STUDENT() . '
            and user.phone_verified = ' . Verified::UNKNOWN() . '
        ');

        foreach ($toReturn as $student) {
            self::queueCampaign($student['user_id'], Campaign::CONFIRMIDENTITY, 1);
            Log::channel('chat')->debug('Added user to verify identity: ' . $student['user_id']);
        }
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
            and message_states.message_id = ' . Campaign::ENDOFCYCLE() . ';
        ');

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
                    branches.response,
                    branches.to_message_id,
                    message_states.id as state_id,
                    message_states.state as state
                from meto_users as users
                join meto_message_states as message_states on message_states.user_id = users.id
                join meto_messages as messages on message_states.message_id = messages.id
                join meto_branches as branches on branches.from_message_id = messages.id
                where users.id = ' . $user_id . '
                and message_states.state in (' . implode(",", [State::WAITING()]) . ')
                order by message_states.message_id asc;
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

    /**
     * @param int $state_id
     * @param State $state
     * @param string|null $body
     */
    public static function updateMessageStateByID(int $state_id, State $state, string $body = null) :void
    {
        DB::update("
            update
                meto_message_states
            set
                state = " . $state() . ",
                response = " . $body . "
            where id = " . $state_id . ";
        ");
    }

    public static function saveResponse(int $state_id, string $body) :void
    {

    }
}
