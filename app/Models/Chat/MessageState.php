<?php

namespace App\Models\Chat;

use App\Enums\Chat\Campaign;
use App\Http\Controllers\ChatbotController;
use Carbon\Carbon;
use App\Enums\User\{Consent, Role, Verified};
use App\Enums\Chat\State;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Chat;

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
        self::queueMessage($user_id, $campaign(), $priority);
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
        } else {
            Log::channel('chat')->debug("Found duplicate message - did not queue");
        }
    }

    /**
     * @return array
     */
    public static function getQueuedMessagesToSend() :array
    {
        $startTime = Carbon::now();
        $toReturn = array();

        // identify queued messages that need verifications or confirmations before sending
        // verifications and confirmations get loaded with higher priorities than campaigns
        self::queueVerifications();
        self::queueConfirmations();

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
            and user.whatsapp_consent != ' . Consent::NOCONSENT() .'
            and state = ' . State::QUEUED() . ';
        ');

        // Look through each message, save one per user, replace if there's one with a lower priority
        // TODO: should be possible to do this in SQL

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

        $runTime = $startTime->diffInMilliseconds(Carbon::now());
        Log::channel('chat')->info('Time to run getQueuedMessagesToSend: ' . $runTime) . 'ms';
        return $toReturn;
    }

    /**
     * Find all users with a queued message of any type that also have an unknown Whatsapp consent status
     */
    public static function queueConfirmations() :void
    {
        // first, find users who just opted out of chat - we need to send them a message outside of the normal process
        // look for a Replied State for Verify campaign and a Queued state for Goodbye campaign
        $consents = Helpers::dbQueryArray('
            select
                user.id as user_id,
                user.phone_combined as phone,
                text
            from meto_users as user
            join meto_message_states as consent on consent.user_id = user.id and consent.message_id = ' . Campaign::CONFIRMPERMISSION() . '
            join meto_message_states as goodbye on goodbye.user_id = user.id and goodbye.message_id = ' . Campaign::GOODBYE() . '
            join meto_messages as messages on messages.id = ' . Campaign::GOODBYE() . '
            where consent.state = ' . State::REPLIED() . '
            and goodbye.state = ' . State::QUEUED() . ';
        ');
        foreach ($consents as $consent) {
            ChatbotController::sendWhatsAppMessage($consent['phone'], $consent['text']);
            DB::update('
                update meto_message_states
                set state = ' . State::COMPLETE() . '
                where user_id = ' . $consent['user_id'] . '
                and (message_id = ' . Campaign::CONFIRMPERMISSION() . ' OR message_id = ' . Campaign::GOODBYE() . ');
            ');
        }

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
        // first, find users who just opted out of chat - we need to send them a message outside of the normal process
        // look for a Replied State for Verify campaign and a Queued state for Goodbye campaign
        $verifications = Helpers::dbQueryArray('
            select
                user.id as user_id,
                user.phone_combined as phone,
                text
            from meto_users as user
            join meto_message_states as verified on verified.user_id = user.id and verified.message_id = ' . Campaign::CONFIRMIDENTITY() . '
            join meto_message_states as goodbye on goodbye.user_id = user.id and goodbye.message_id = ' . Campaign::GOODBYE() . '
            join meto_messages as messages on messages.id = ' . Campaign::GOODBYE() . '
            where verified.state = ' . State::REPLIED() . '
            and goodbye.state = ' . State::QUEUED() . ';
        ');
        foreach ($verifications as $verification) {
            ChatbotController::sendWhatsAppMessage($verification['phone'], $verification['text']);
            DB::update('
                update meto_message_states
                set state = ' . State::COMPLETE() . '
                where user_id = ' . $verification['user_id'] . '
                and (message_id = ' . Campaign::CONFIRMIDENTITY() . ' OR message_id = ' . Campaign::GOODBYE() . ');
            ');
        }

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
    public static function getState(int $user_id) :?array
    {
        $result = Helpers::dbQueryArray('
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
                    message_states.id as state_id,
                    message_states.state as state
                from meto_users as users
                join meto_message_states as message_states on message_states.user_id = users.id
                join meto_messages as messages on message_states.message_id = messages.id
                where users.id = ' . $user_id . '
                and message_states.state in (' . implode(",", [State::WAITING()]) . ')
                order by message_states.message_id asc;
            ');

        if (count($result) == 0) { // No state found, unexpected message
            Log::channel('chat')->error('Unexpected Whatsapp from User ' . $user_id);
            // TODO: send notification to team member?
            return null;
        }
        if (count($result) > 1) { // Multiple states found, unexpected condition
            // TODO: send notification to team member?
            Log::channel('chat')->error("Too many states: " . print_r($currentState));
            return null;
        }

        return $result[0];
    }

    /**
     * @param int $state_id
     * @param State $state
     */
    public static function updateMessageStateByID(int $state_id, State $state) :void
    {
        DB::update("
            update meto_message_states set state = " . $state() . " where id = " . $state_id . ";
        ");
    }

    public static function saveResponseInState(int $state_id, string $body) :void
    {
        // write raw response into messagestate table
        DB::update("
            update meto_message_states set response = '" . $body . "' where id = " . $state_id . ";
        ");
    }

    public static function saveResponseInSchema(int $user_id, int $state_id, Branch $branch) :void
    {
        // find appropriate campaign and save translated response in the schema
        // TODO: this is just bad all over the place
        switch ($branch->getCampaign()) {
            case Campaign::CONFIRMIDENTITY:
                $value = ($branch->response == 'Y') ? Verified::VERIFIED() : Verified::DENIED();
                DB::update('
                    update meto_users set phone_verified = ' . $value .' where id = ' . $user_id . ';
                ');
                break;
            case Campaign::CONFIRMPERMISSION:
                $value = ($branch->response == 'Y') ? Consent::CONSENT() : Consent::NOCONSENT();
                DB::update('
                    update meto_users set whatsapp_consent = ' . $value .' where id = ' . $user_id . ';
                ');
                break;
            case Campaign::ENDOFCYCLE:
                // no response needed
                break;

            default:
                Log::channel('chat')->error('State ' . $state_id . ' could not find a campaign');
                break;
        }
    }
}
