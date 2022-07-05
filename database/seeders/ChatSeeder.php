<?php

namespace Database\Seeders;

use App\Enums\General\Chat;
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
        $message->id = Chat::CONFIRMIDENTITY;
        $message->text = "Hi, this is Meto. Can you confirm that you are {{user.name}}?";
        $message->capture_filter = "Y,N";
        $message->capture_display = "Yes / No";
        $message->answer_table = "users"; // user validation field
        $message->answer_field = "phone_verified";
        $message->branch_id = 1;
        $message->save();

        $branch = new Branch();
        $branch->id = 1;
        $branch->from_message_id = Chat::CONFIRMIDENTITY;
        $branch->response = "N";
        $branch->to_message_id = "2";
        $branch->save();

        $branch = new Branch();
        $branch->id = 2;
        $branch->from_message_id = 1;
        $branch->response = "Y";
        $branch->to_message_id = "3";
        $branch->save();

        $message = new Message();
        $message->id = 2;
        $message->text = "No problem! We won't message you any more.";
        $message->save();

        $message = new Message();
        $message->id = Chat::CONFIRMPERMISSION;
        $message->text = "Do we have your permission to use WhatsApp to collect some information from you?";
        $message->capture_filter = "Y,N";
        $message->capture_display = "Y/N";
        $message->answer_table = "students"; // user communication agreement field
        $message->answer_field = "whatsapp_consent";
        $message->branch_id = 2;
        $message->save();

        $branch = new Branch();
        $branch->id = 3;
        $branch->from_message_id = 3;
        $branch->response = "N";
        $branch->to_message_id = 2;
        $branch->save();

        $branch = new Branch();
        $branch->id = 4;
        $branch->from_message_id = 3;
        $branch->response = "Y";
        $branch->save();

        $message = new Message();
        $message->id = Chat::ENDOFCYCLE;
        $message->text = "Please click the link below to let us know how your university applications are going. {{application_status_form}}";
        $message->save();
    }
}
