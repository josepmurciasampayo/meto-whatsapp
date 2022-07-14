<?php

namespace App\Http\Controllers;

use App\Enums\General\Channel;
use App\Enums\General\Chat;
use App\Models\Chat\Message;
use App\Models\Chat\MessageState;
use App\Models\LogComms;
use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class ChatbotController extends Controller
{
    /**
     * Runs at a scheduled time to test all potential triggers and identify new conversations to start
     * @returns void
     */
    public static function initiateLoop() :void
    {
        self::endOfApplicationCycle();
        // more questions with different triggers follow

        $toSend = MessageState::getNewMessagesToSend();
        foreach ($toSend as $message) {
            $phone = $message['phone_country'] . $message['phone_area'] . $message['phone_local'];
            self::sendWhatsAppMessage($phone, $message['text']);
            MessageState::updateMessageState($message['message_state_id'], \App\Enums\General\MessageState::SENT);
        }
    }

    /**
     * Finds users at the end of an application cycle and messages them about application plans
     */
    public static function endOfApplicationCycle() :void
    {
        $users = MessageState::getEndOfApplicationCycles();
        foreach ($users as $user) {
            MessageState::startMessage($user['user_id'], Chat::ENDOFCYCLE);
        }
    }

    /**
     * Takes a message, scans to see if it has any template directives, returns hydrated string
     * @param string $message String with template directives
     * @return string String with replaced data
     */
    public static function hydrateMessage(string $message) :string
    {
        if (str_contains($message, "{")) {
            $startPos = strpos($message, '{');
            $endPos = strpos($message, '}');
            $length = strlen($message) - $endPos;
            $field = substr($message, $startPos, $length);
            if ($field == 'application_status') {

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
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, I don't recognize your number: " . $from);
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
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, " . $user->first . ", I wasn't expecting to hear from you.");
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
    public static function sendWhatsAppMessage(string $recipient, string $message = "")
    {
        $log = new LogComms([
            'channel' => Channel::WHATSAPP,
            'from' => "METO",
            'to' => $recipient,
            'body' => $message,
        ]);
        $log->save();

        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        $result = $client->messages->create(
            "whatsapp:+". $recipient,
            array('from' => "whatsapp:+". $twilio_whatsapp_number, 'body' => self::hydrateMessage($message))
        );
        echo $result;
    }
}
