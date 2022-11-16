<?php

namespace App\Http\Controllers;

use App\Enums\Chat\State;
use App\Enums\Chat\Campaign;
use App\Enums\General\Channel;
use App\Enums\General\Form;
use App\Enums\User\Role;
use App\Helpers;
use App\Models\Chat\Branch;
use App\Models\Chat\Message;
use App\Models\Chat\MessageState;
use App\Models\LogComms;
use App\Models\StudentUniversity;
use App\Models\Student;
use App\Models\User;
use App\Models\UserForm;
use Database\Seeders\ChatTestSeeder;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class ChatbotController extends Controller
{
    /**
     * Runs at a scheduled time to test all potential triggers and identify new conversations to start
     * Queues new campaigns to start, looks for verifications and confirmations, then sends all queued messages
     * @returns void
     */
    public static function startLoop() :void
    {
        Log::channel('chat')->debug('Starting chat loop');

        $users = MessageState::getEndOfApplicationCycles();
        foreach ($users as $user) {
            MessageState::queueCampaign($user['user_id'], Campaign::ENDOFCYCLE, 3);
        }

        $toSend = MessageState::getQueuedMessagesToSend();
        foreach ($toSend as $message) {
            self::sendWhatsAppMessage($message['phone'], $message['text'], $message['user_id']);
            $newState = ($message['wait_for_reply']) ? State::WAITING : State::COMPLETE;
            MessageState::updateMessageStateByID($message['state_id'], $newState);
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
                $url = env('APP_URL') . "/form/" . $form->url;
                $message = str_replace("{form_application_status}", $url, $message);
            }
            if (str_contains($message, '{first}')) {
                $user = User::find($user_id);
                $first = $user->first;
                Log::channel('chat')->debug('Found first name: ' . $first . ' for user ID ' . $user_id);
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
        $from = Helpers::stripNonNumeric($request->input('From'));
        $body = $request->input('Body');

        // Logging
        Helpers::log(Channel::WHATSAPP, $from, "METO", $body);
        Log::channel('chat')->debug('Received WhatsApp from ' . $from . ': ' . $body);

        $body = Message::collapseResponses(str_replace(".", "", $request->input('Body')));

        try {
            // Find which user messaged, if we can't identify there's not much else to do
            $user = User::getByPhone($from);
            if (is_null($user)) {
                Log::channel('chat')->error("Couldn't find user with phone " . $from . ". They WhatsApp'd: " . $body);
                ChatbotController::sendWhatsAppMessage($from, "I'm sorry, I don't recognize your number: " . $from);
                return;
            }

            // Get any waiting states and error handle
            $currentState = MessageState::getState($user->id, [State::WAITING()]);
            if (is_null($currentState)) {
                Log::channel('chat')->error("Couldn't find existing state for " . $user->email);
                self::sendWhatsAppMessage($from, "I'm sorry, {first}. I wasn't expecting to hear from you but I've forwarded your message to our staff.", $user->id);
                // TODO: notify staff?
                return;
            }

            // Branching and saving response
            MessageState::saveResponseInState($currentState['state_id'], $body);
            $branch = Branch::getBranchByMessageAndResponse($currentState['message_id'], $body);

            if (is_null($branch)) {
                Log::channel('chat')->error('Branch not found for input: ' . $body);
                $from = Helpers::stripNonNumeric($from);
                self::sendWhatsAppMessage($from, "I didn't understand that - please try again?", $user->id);
                return;
            }

            MessageState::saveResponseInSchema($user->id, $currentState['state_id'], $branch);
            MessageState::updateMessageStateByID($currentState['state_id'], State::REPLIED);

            MessageState::queueMessage($user->id, $branch->to_message_id);

            // restart loop to handle any new queued messages
            self::startLoop();
        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            Log::channel('chat')->error('Chat exception: ' . $th);
            Log::channel('chat')->error('Chat response: ' . $response);
        }
    }

    /**
     * Sends a WhatsApp message to user using
     * @param string $message Body of message
     * @param array $recipient Number of recipient
     * @throws \Twilio\Exceptions\TwilioException
     */
    public static function sendWhatsAppMessage(string $recipient, string $message, int $user_id = null) :void
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
        try {
            $result = $client->messages->create(
                "whatsapp:+" . $recipient,
                array('from' => "whatsapp:+" . $twilio_whatsapp_number, 'body' => $message)
            );
        } catch (TwilioException $e) {
            Log::channel('chat')->error("Error sending WhatsApp: " . $e);
        }
    }

    public static function reset() :void
    {
        if (App::environment('local')) {
            MessageState::truncate();
            LogComms::truncate();
            User::deleteByRole(Role::STUDENT);
            UserForm::truncate();
            Student::truncate();
            StudentUniversity::truncate();
            //Session::flush();
            $seeder = new ChatTestSeeder();
            $seeder->run();
        }
    }
}
