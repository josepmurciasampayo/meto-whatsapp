<?php

namespace App\Models\Chat;

use App\Enums\Chat\Campaign;
use App\Enums\EnumGroup;
use App\Http\Controllers\ChatbotController;
use Carbon\Carbon;
use App\Enums\User\{Consent, Role, Verified};
use App\Enums\Chat\State;
use App\Helpers;
use Faker\Extension\Helper;
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
    public static function queueMessage(int $user_id, int $message_id, int $priority = 3) :bool
    {
        if (is_null($message_id) || ($message_id == Campaign::NOBRANCH())) {
            // nothing to do
            return false;
        }

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
            Log::channel('chat')->debug("Queueing message " . $message_id . " for user " . $user_id);

        }

        return true;
    }

    /**
     * @return array
     */
    public static function getQueuedMessagesToSend() :array
    {
        $startTime = Carbon::now();
        $toReturn = array();

        // identify queued messages that need verifications or confirmations before sending
        $usersWaitingCount = DB::select('select count(*) as c from meto_message_states where state = 2;')[0]->c;
        if ($usersWaitingCount > 0) {
            $usersWaiting = Helpers::dbQueryArray('
                select distinct group_concat(user_id) as u from meto_message_states where state = ' . State::WAITING() . ';
            ');
            $usersWaiting = ' and user.id not in (' . $usersWaiting[0]["u"] . ')';
        } else {
            $usersWaiting = '';
        }

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
            where user.role = ' . Role::STUDENT() .
             $usersWaiting . '
            and user.phone_verified != ' . Verified::DENIED() . '
            and user.whatsapp_consent != ' . Consent::NOCONSENT() .'
            and state in (' . State::QUEUED() . ');
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
        if ($runTime > 50) {
            Log::channel('chat')->info('Time to run getQueuedMessagesToSend: ' . $runTime . 'ms');
        }
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
     * @param int|null $user_id
     * @param array|null $states
     * @return array|null
     */
    public static function getState(int $user_id = null, ?array $states = null) :?array
    {
        $whereClause = '';
        if (isset($user_id)) {
            $whereClauses[] = 'u.id = ' . $user_id;
        }
        if (isset($states)) {
            $whereClauses[] = 's.state in (' . implode(",", $states) . ')';
        }
        if (isset($whereClauses)) {
            $whereClause = ' where ' . implode(' and ', $whereClauses);
        }

        $toReturn = Helpers::dbQueryArray('
            select
                u.id as user_id,
                concat(u.first, " ", u.last) as "name",
                u.email,
                m.id as message_id,
                m.text,
                m.capture_filter,
                m.answer_table,
                m.answer_field,
                s.id as state_id,
                s.state as message_state,
                campaign.enum_desc as "campaign",
                priority,
                state.enum_desc as "state",
                response
            from meto_users as u
            join meto_message_states as s on s.user_id = u.id
            join meto_messages as m on s.message_id = m.id
            join meto_enum as campaign on campaign.group_id = ' . EnumGroup::CHAT_CAMPAIGNS() .' and campaign.enum_id = message_id
            join meto_enum as state on state.group_id = ' . EnumGroup::CHAT_STATE() . ' and state.enum_id = state
            ' . $whereClause . '
            order by s.message_id asc;
        ');

        if (isset($user_id)) { //checking for just one user
            if (count($toReturn) == 0) { // No state found, unexpected message
                Log::channel('chat')->error('Unexpected Whatsapp from User ' . $user_id);
                // TODO: send notification to team member?
                return null;
            }
            if (isset($user_id) && count($toReturn) > 1) { // Multiple states found, unexpected condition
                Log::channel('chat')->error("Too many states: " . print_r($toReturn));
                return null;
            }

            return $toReturn[0]; // return just the first record for the relevant user
        }

        return $toReturn; // return all records for an admin user
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

    /**
     * @param int $state_id
     * @param string $body
     */
    public static function saveResponseInState(int $state_id, string $body) :void
    {
        // write raw response into messagestate table
        DB::update("
            update meto_message_states set response = '" . $body . "' where id = " . $state_id . ";
        ");
    }

    /**
     * @param int $user_id
     * @param int $state_id
     * @param Branch $branch
     */
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
                return;
            case Campaign::CONFIRMPERMISSION:
                $value = ($branch->response == 'Y') ? Consent::CONSENT() : Consent::NOCONSENT();
                DB::update('
                    update meto_users set whatsapp_consent = ' . $value .' where id = ' . $user_id . ';
                ');
                return;
            case Campaign::ENDOFCYCLE:
                // no response needed
                return;

            default:
                Log::channel('chat')->error('State ' . $state_id . ' could not find a campaign');
                return;
        }
    }
}
