<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageState;
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
        endOfApplicationCycle();
        // more questions with different triggers follow
    }

    /**
     * Finds users at the end of an application cycle and messages them about application plans
     */
    public static function endOfApplicationCycle() :void
    {
        $ids = DB::select('');
        foreach ($ids as $id) {
            MessageState::startQuestion($id, 2);
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
    public function listenToReply(Request $request)
    {
        $from = $request->input('From');
        $body = Message::collapseResponses(str_replace(".", "", $request->input('Body')));

        $client = new \GuzzleHttp\Client();
        try {
            // get all necessary database info to parse reply
            // user, message, message state, and branch data
            $currentState = DB::select('
                select
                    users.id,
                    users.first,
                    users.last,
                    users.email,
                    messages.id,
                    messages.text,
                    messages.capture_filter,
                    messages.answer_table,
                    messages.answer_field,
                    messages.branch_id,
                    branches.response,
                    branches.to_message_id,
                    message_states.id,
                    message_states.state
                from users
                join message_states on message_states.user_id = users.id
                join messages on message_states.message_id = messages.id
                join branches on branches.from_message_id = messages.id
                where users.phone = ' . $from . '
            ');

            if ($body == "end of cycle") {

            }

            // apply capture filter
            $collaspedResponse = Message::collapseResponses($body);
            if ($body) {
              ChatbotController::sendWhatsAppMessage($from, "I'm sorry, I don't understand. Can you try again?");
            }
            // save reply in MessageState and update State
            // look at branch
            // trigger next message


        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            $this->sendWhatsAppMessage($response->message, $from);
        }
        return;
    }

    /**
     * Sends a WhatsApp message to user using
     * @param string $message Body of message
     * @param array $recipient Number of recipient
     */
    public static function sendWhatsAppMessage(string $recipient, string $message = "")
    {
        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        return $client->messages->create($recipient, array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => ChatbotController::hydrateMessage($message)));
    }
}
