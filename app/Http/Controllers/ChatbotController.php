<?php

namespace App\Http\Controllers;

use App\Enums\Chat\State;
use App\Enums\Chat\Campaign;
use App\Enums\General\Channel;
use App\Enums\General\Form;
use App\Helpers;
use App\Models\Chat\Branch;
use App\Models\Chat\Message;
use App\Models\Chat\MessageState;
use App\Models\LogComms;
use App\Models\User;
use App\Models\UserForm;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class ChatbotController extends Controller
{
    /**
     * Runs at a scheduled time to test all potential triggers and identify new conversations to start
     * @returns void
     */
    public static function initiateLoop() :void
    {
        Log::channel('chat')->debug('Starting chat loop initiation');

        // methods here correspond to specific chat campaigns
        self::endOfApplicationCycle();

        // after new campaign messages are identified and queued, loop through to send them
        $toSend = MessageState::getNewMessagesToSend();
        Log::channel('chat')->debug("New messages to send: " . print_r($toSend, true));
        foreach ($toSend as $message) {
            $phone = $message['phone_country'] . $message['phone_area'] . $message['phone_local'];
            self::sendWhatsAppMessage($phone, $message['text'], $message['user_id']);
            MessageState::updateMessageState($message['user_id'], $message['message_state_id'], State::SENT);
        }

        Log::channel('chat')->debug('End of chat loop');
    }

    /**
     * Finds users at the end of an application cycle and messages them about application plans
     */
    public static function endOfApplicationCycle() :void
    {
        $users = MessageState::getEndOfApplicationCycles();
        Log::channel('chat')->debug('Found ' . count($users) . ' to start the End of App cycle');
        foreach ($users as $user) {
            MessageState::startMessage($user['user_id'], Campaign::ENDOFCYCLE());
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
                Log::channel('chat')->debug('Found form_application_status');
                $form = UserForm::getForm($user_id, Form::ENDOFCYCLE);
                $url = "https://app.meto-intl.org/form/" . $form->url;
                $message = str_replace("{form_application_status}", $url, $message);
            }
            if (str_contains($message, '{first}')) {
                $first = User::find($user_id)->first()->first;
                Log::channel('chat')->debug('Found first name: ' . $first);
                $message = str_replace("{first}", $first, $message);
            }
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
        Helpers::log(Channel::WHATSAPP, $from, "METO", $body);
        $body = Message::collapseResponses(str_replace(".", "", $request->input('Body')));

        try {
            $user = User::findFromPhone($from);
            if (is_null($user)) {
                Log::channel('chat')->error("Couldn't find user with phone " . $from . ". They WhatsApp'd: " . $body);
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, I don't recognize your number: " . $from, null);
                return;
            }

            $currentState = MessageState::getState($user->id);

            if (count($currentState) == 0) {
                Log::channel('chat')->error('Unexpected Whatsapp from User ' . $user->id);
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, " . $user->first . ", I wasn't expecting to hear from you.", $user->id);
                // TODO: send notification to team member?
                return;
            }
            if (count($currentState) > 1) {
                // TODO: send notification to team member?
                Log::channel('chat')->error("Too many states: " . print_r($currentState));
                return;
            }

            $branch = Branch::where([
                'from_message_id', $currentState['message_id'],
                'response', $body
            ])->first();

            if (is_null($branch)) {
                Log::channel('chat')->debug('Branch not found: ' . $user->id);
                // TODO: queue message to resend with filter
            }

            MessageState::updateMessageStateByID($currentState['state_id'], State::REPLIED);
            MessageState::startMessage($user->id, $branch->to_message_id);
        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            Log::channel('chat')->debug('Chat exception: ' . $th);
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
        $body = self::hydrateMessage($message, $user_id);
        $log = new LogComms([
            'channel' => Channel::WHATSAPP,
            'from' => "METO",
            'to' => $recipient,
            'body' => $body,
        ]);
        $log->save();
        Log::channel('chat')->debug($log);

        $twilio_whatsapp_number = getenv('GREG_TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("GREG_TWILIO_SID");
        $auth_token = getenv("GREG_TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        $result = $client->messages->create(
            "whatsapp:+". $recipient,
            array('from' => "whatsapp:+". $twilio_whatsapp_number, 'body' => $body)
        );
        Log::channel('chat')->debug($result);
    }
}
