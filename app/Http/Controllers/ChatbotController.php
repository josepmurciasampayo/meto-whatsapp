<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class ChatbotController extends Controller
{
    /**
     * Runs at a scheduled time every day to test all potential triggers and identify new conversations to start
     * @param DB $db database to search for triggers
     * @returns void
     */
    public function everyDay() :void
    {
        $peopleToMessage = $this->findWhatsAppUsers();
        foreach ($peopleToMessage as $person) {
            $this->sendWhatsAppMessage($person[''], $person['']);
        }
    }

    /**
     * Identifies users and question to begin conversations, updates QuestionState table
     * @param DB
     * @returns array of identified users that need a message [user_id, question_id]
     */
    public function findWhatsAppUsers() :array
    {
        $toReturn = array();

        runTriggers();

        return $toReturn;
    }

    /**
     *
     */
    public function runTriggers() :void
    {
        endOfApplicationCycle();
    }

    /**
     *
     */
    public function endOfApplicationCycle() :void
    {
        //$ids = $db->select('');
        // foreach
        //$db->update('insert into QuestionState () values ()');
    }

    /**
     * Sends a WhatsApp message to user using
     * @param string $message Body of message
     * @param array $recipient Number of recipient
     */
    public function sendWhatsAppMessage(int $messageID, string $recipient, string $message = "")
    {
        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        return $client->messages->create($recipient, array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $this->hydrateMessage($message)));
    }

    /**
     * Takes a message, scans to see if it has any template directives, returns hydrated string
     * @param DB $db
     * @param string $message String with template directives
     * @return string String with replaced data
     */
    public function hydrateMessage(string $message) :string
    {
        if (str_contains($message, "{{")) {
            return $message;
        } else {
            return $message;
        }
    }

    /**
     * Identifies users and associated data to begin conversations
     */
    public function listenToReply(Request $request)
    {
        $from = $request->input('From');
        $body = $request->input('Body');

        $client = new \GuzzleHttp\Client();
        try {
            // find state for that user
            $this->sendWhatsAppMessage(0, $from,"Message received");
            // save reply
            // look at branch



        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            $this->sendWhatsAppMessage($response->message, $from);
        }
        return;
    }

}
