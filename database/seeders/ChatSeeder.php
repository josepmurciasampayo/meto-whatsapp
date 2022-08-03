<?php

namespace Database\Seeders;

use App\Enums\Chat\Campaign;
use App\Models\Chat\Branch;
use App\Models\Chat\Message;

use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * User identity verification and communication agreement loop
         */
        $message = new Message();
        $message->id = Campaign::CONFIRMIDENTITY;
        $message->text = "Hi, this is Meto. Can you confirm that you are {first}?";
        $message->capture_filter = "Y,N";
        $message->capture_display = "Yes / No";
        $message->answer_table = "users"; // user validation field
        $message->answer_field = "phone_verified";
        $message->save();

        $branch = new Branch();
        $branch->from_message_id = Campaign::CONFIRMIDENTITY;
        $branch->response = "N";
        $branch->to_message_id = 4;
        $branch->save();

        $branch = new Branch();
        $branch->from_message_id = 1;
        $branch->response = "Y";
        $branch->to_message_id = Campaign::CONFIRMPERMISSION;
        $branch->save();

        $message = new Message();
        $message->id = 4;
        $message->text = "No problem! We won't message you any more.";
        $message->save();

        $message = new Message();
        $message->id = Campaign::CONFIRMPERMISSION;
        $message->text = "Do we have your permission to use WhatsApp and our website to collect some information from you?";
        $message->capture_filter = "Y,N";
        $message->capture_display = "Y/N";
        $message->answer_table = "students"; // user communication agreement field
        $message->answer_field = "whatsapp_consent";
        $message->save();

        $branch = new Branch();
        $branch->from_message_id = Campaign::CONFIRMPERMISSION;
        $branch->response = "N";
        $branch->to_message_id = 4;
        $branch->save();

        $message = new Message();
        $message->id = Campaign::ENDOFCYCLE;
        $message->text = "Please click the link to let us know how your university applications are going. {form_application_status} If you have any questions, you can message us here.";
        $message->save();

        $message = new Message();
        $message->id = Campaign::UNKNOWNMESSAGE;
        $message->text = "Sorry, {first}, I wasn't expecting to hear from you. I will forward your message to our office. I will keep forwarding anything you message me. Thanks!";
        $message->save();

    }
}
