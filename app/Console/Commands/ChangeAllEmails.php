<?php

namespace App\Console\Commands;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class ChangeAllEmails extends Command implements PromptsForMissingInput
{
    protected $signature = 'app:change-all-emails {email}';

    protected $description = 'Command description';

    public function handle()
    {
        $components = str_split($this->argument('email'), strpos($this->argument('email'), '@'));
//        $users = User::all();
//        foreach ($users as $user) {
//            $user->email = $components[0] . "+" . $user->id . $components[1];
//            $user->save();
//        }

        $connections = Connection::whereNotNull('cc_emails')->get();
        foreach ($connections as $connection) {
            $connection->cc_emails = $components[0] . "+" . $connection->institution_id . $components[1];
            $connection->save();
        }
    }

    protected function promptForMissingArgumentsUsing()
    {
        return [
            'email' => 'Please enter the email address to use: '
        ];
    }
}
