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
    public static function startLoop() :void
    {
        Log::channel('chat')->debug('Starting chat loop');
        // methods here correspond to specific chat campaigns
        self::endOfApplicationCycle();

        $toSend = MessageState::getQueuedMessagesToSend();

        Log::channel('chat')->debug("Found new messages to send: " . print_r($toSend, true));
        foreach ($toSend as $message) {
            self::sendWhatsAppMessage($message['phone'], $message['text'], $message['user_id'], $message['state_id']);
            $newState = ($message['wait_for_reply']) ? State::WAITING : State::COMPLETE;
            MessageState::updateMessageStateByID($message['state_id'], $newState);
        }

        Log::channel('chat')->debug('Ending chat loop');
    }

    /**
     * Finds users at the end of an application cycle and messages them about application plans
     */
    public static function endOfApplicationCycle() :void
    {
        $users = MessageState::getEndOfApplicationCycles();
        Log::channel('chat')->debug('Found ' . count($users) . ' to start the End of App cycle');
        foreach ($users as $user) {
            MessageState::queueCampaign($user['user_id'], Campaign::ENDOFCYCLE, 3);
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

        // Logging
        Helpers::log(Channel::WHATSAPP, $from, "METO", $body);
        $body = Message::collapseResponses(str_replace(".", "", $request->input('Body')));
        Log::channel('chat')->debug('Received WhatsApp from ' . $from . ': ' . $body);

        try {
            $user = User::findFromPhone($from);
            if (is_null($user)) {
                Log::channel('chat')->error("Couldn't find user with phone " . $from . ". They WhatsApp'd: " . $body);
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, I don't recognize your number: " . $from, null, null);
                return;
            }

            // Get state and error handle
            $currentState = MessageState::getState($user->id);
            if (is_null($currentState)) {
                return;
            }

            // Branching and saving response
            $branch = Branch::getBranchByMessageAndResponse($currentState['message_id'], $body);

            if (is_null($branch)) {
                Log::channel('chat')->error('Branch not found: ' . $user->id);
                self::sendWhatsAppMessage($from, "I didn't understand that - please try again?", $user->id, $currentState['state_id']);
                return;
            }

            MessageState::saveResponse($user->id, $currentState['state_id'], $body, $branch);
            MessageState::updateMessageStateByID($currentState['state_id'], State::REPLIED);

            if (!is_null($branch->to_message_id)) {
                MessageState::queueMessage($user->id, $branch->to_message_id);
            }

            self::startLoop();
        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            Log::channel('chat')->error('Chat exception: ' . $th);
            Log::channel('chat')->error('Chat response: ' . $response);
            // TODO: log exception and notify
        }
    }

    /**
     * Sends a WhatsApp message to user using
     * @param string $message Body of message
     * @param array $recipient Number of recipient
     * @throws \Twilio\Exceptions\TwilioException
     */
    public static function sendWhatsAppMessage(string $recipient, string $message, ?int $user_id, ?int $state_id) :void
    {
        if (!is_null($user_id)) {
            $message = self::hydrateMessage($message, $user_id);
        }
        $log = new LogComms([
            'channel' => Channel::WHATSAPP,
            'from' => "METO",
            'to' => $recipient,
            'body' => $message,
        ]);
        $log->save();
        Log::channel('chat')->debug($log);

        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        $result = $client->messages->create(
            "whatsapp:+". $recipient,
            array('from' => "whatsapp:+". $twilio_whatsapp_number, 'body' => $message)
        );
        Log::channel('chat')->debug($result);
        // TODO: error handle here
        /*if (&& !is_null($state_id)) {
            MessageState::updateMessageStateByID($state_id, State::ERROR);
        }*/
    }
}
