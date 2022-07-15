<?php

namespace App\Http\Controllers;

use App\Enums\General\Channel;
use App\Enums\General\Chat;
use App\Enums\General\Form;
use App\Enums\General\FormStatus;
use App\Models\Chat\Message;
use App\Models\Chat\MessageState;
use App\Models\LogComms;
use App\Models\User;
use App\Models\UserForm;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class ChatbotController extends Controller
{
    /**
     * Runs at a scheduled time to test all potential triggers and identify new conversations to start
     * @returns void
     */
    public static function initiateLoop() :void
    {
        Log::info("Starting message loop");
        // methods here correspond to specific chat campaigns
        self::endOfApplicationCycle();

        // after new campaign messages are identified and queued, loop through to send them
        $toSend = MessageState::getNewMessagesToSend();
        foreach ($toSend as $message) {
            $phone = $message['phone_country'] . $message['phone_area'] . $message['phone_local'];
            self::sendWhatsAppMessage($phone, $message['text'], $message['user_id']);
            MessageState::updateMessageState($message['user_id'], $message['message_state_id'], \App\Enums\General\MessageState::SENT);
        }
        Log::info("Ending message loop");
    }

    /**
     * Finds users at the end of an application cycle and messages them about application plans
     */
    public static function endOfApplicationCycle() :void
    {
        $users = MessageState::getEndOfApplicationCycles();
        Log::info("Found " . count($users) . " users with end of cycle");
        foreach ($users as $user) {
            MessageState::startMessage($user['user_id'], Chat::ENDOFCYCLE);
            Log::info("Finished end of cycle for user " . $user['user_id']);
        }
    }

    /**
     * Takes a message, scans to see if it has any template directives, returns hydrated string
     * @param string $message String with template directives
     * @return string String with replaced data
     */
    public static function hydrateMessage(string $message, int $user_id) :string
    {
        if (str_contains($message, "{")) { // means there's *something* to replace, we'll look individually for each thing
            if (str_contains($message, '{form_application_status}')) {
                $form = UserForm::getForm($user_id, Form::ENDOFCYCLE);
                $url = "https://app.meto-intl.org/form/" . $form->url;
                $message = str_replace("{form_application_status}", $url, $message);
            }
            if (str_contains($message, '{first}')) {
                $first = User::find($user_id)->first()->first;
                Log::info("Found " . $first);
                $message = str_replace("{first}", $first, $message);
            }
            // parse database table and column name
            // execute query
            // replace text with query result
            return $message;
        } else {
            return $message;
        }
    }

    /**
     * Identifies users and associated data to begin conversations
     */
    public function listenToReply(Request $request) :void
    {
        $from = $request->input('From');
        $body = $request->input('Body');
        $log = new LogComms([
            'channel' => Channel::WHATSAPP,
            'from' => $from,
            'to' => "METO",
            'body' => $body,
        ]);
        $log->save();
        $body = Message::collapseResponses(str_replace(".", "", $request->input('Body')));

        try {
            // get all necessary database info to parse reply
            // user, message, message state, and branch data

            $user = User::where('phone', $from)->first();
            if (is_null($user)) {
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, I don't recognize your number: " . $from, null);
                return;
            }

            if ($body == "end of cycle") {
                $newEndOfCycleChat = new MessageState([
                    'user_id' => $user->id,
                    'message_id' => Chat::ENDOFCYCLE,
                    'state' => \App\Enums\General\MessageState::QUEUED,
                ]);
                $newEndOfCycleChat->save();
                return;
            }

            $currentState = MessageState::getState($from);
            if (count($currentState) == 0) {
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, " . $user->first . ", I wasn't expecting to hear from you.", $user->id);
                // TODO: send notification to team member?
                return;
            }

            // save reply in MessageState and update State
            // look at branch
            // trigger next message


        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            // TODO: log exception and notify
        }
    }

    /**
     * Sends a WhatsApp message to user using
     * @param string $message Body of message
     * @param array $recipient Number of recipient
     * @throws \Twilio\Exceptions\TwilioException
     */
    public static function sendWhatsAppMessage(string $recipient, string $message, int $user_id) :void
    {
        $log = new LogComms([
            'channel' => Channel::WHATSAPP,
            'from' => "METO",
            'to' => $recipient,
            'body' => $message,
        ]);
        $log->save();

        $twilio_whatsapp_number = getenv('GREG_TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("GREG_TWILIO_SID");
        $auth_token = getenv("GREG_TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        $result = $client->messages->create(
            "whatsapp:+". $recipient,
            array('from' => "whatsapp:+". $twilio_whatsapp_number, 'body' => self::hydrateMessage($message, $user_id))
        );
    }
}
