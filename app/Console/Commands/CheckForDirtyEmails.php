<?php

namespace App\Console\Commands;

use App\Exports\DirtyEmailsExport;
use App\Models\User;
use Illuminate\Console\Command;

class CheckForDirtyEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-for-dirty-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iterates through all the users and check for the ones that have incorrect emails.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $output = '--ID:--      --EMAIL--';
        $outputArray = [];

        foreach (User::all() as $user) {
            if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                $output .= PHP_EOL . ' ' . $user->id . ':       ' . $user->email . PHP_EOL;
                $outputArray[$user->id] = $user->email;
            }
        }

        echo $output;

        // For testing purpose
//        foreach ($outputArray as $id => $email) {
//            User::find($id)->update(['email' => 'test-email-' . $id . '@test.,com']);
//        }
    }
}
