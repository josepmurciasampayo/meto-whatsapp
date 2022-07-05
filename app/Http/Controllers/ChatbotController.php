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
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class ChatbotController extends Controller
{
    /**
     * Runs at a scheduled time every day to test all potential triggers and identify new conversations to start
     * @returns void
     */
    public static function initiateDailyLoop() :void
    {
        ChatbotController::runTriggers();
        ChatbotController::sendMessages();
    }

    /**
     * Collection of individual triggers for each question set
     */
    public static function runTriggers() :void
    {
        self::endOfApplicationCycle();
        // more questions with different triggers follow
    }

    /**
     * Finds users at the end of an application cycle and messages them about application plans
     */
    public static function endOfApplicationCycle() :void
    {
        $ids = DB::select('');
        foreach ($ids as $id) {
            MessageState::startQuestion($id, Chat::ENDOFCYCLE);
        }
    }

    /*
     * Gets all the messages to be sent, initiates the sending and updates the state
     */
    public static function sendMessages() :void
    {
        $messages = MessageState::getMessagesToSend();
        foreach($messages as $message) {
            self::sendWhatsAppMessage($message['number'], $message['message']);
            MessageState::updateMessageState($message['user_id'], $message['message_id'], 3);
        }
    }

    /**
     * Takes a message, scans to see if it has any template directives, returns hydrated string
     * @param string $message String with template directives
     * @return string String with replaced data
     */
    public static function hydrateMessage(array $message) :string
    {
        if (str_contains($message['text'], "{")) {
            $startPos = strpos($message['text'], '{');
            $endPos = strpos($message['text'], '}');
            $length = strlen($message['text']) - $endPos;
            $field = substr($message['text'], $startPos, $length);
            if ($field == 'application_status') {

            }
            // parse database table and column name
            // execute query
            // replace text with query result
            return $message['text'];
        } else {
            return $message['text'];
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

            $user = User::findUserByPhoneNumber($from);
            if (is_null($user)) {
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, I don't recognize your number: " . $from);
                return;
            }

            $currentState = MessageState::getState($from);
            if (count($currentState) == 0) {
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, " . $user->first . ", I wasn't expecting to hear from you.");
                return;
            }

            if ($body == "end of cycle") {
                $newEndOfCycleChat = new MessageState([
                    'user_id' => $currentState['user_id'],
                    'message_id' => Chat::ENDOFCYCLE,
                    'state' => \App\Enums\General\MessageState::QUEUED,
                ]);
                $newEndOfCycleChat->save();
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
        $client->messages->create(
            $recipient,
            ['from' => "whatsapp:$twilio_whatsapp_number", 'body' => ChatbotController::hydrateMessage($message)]
        );
    }
}
