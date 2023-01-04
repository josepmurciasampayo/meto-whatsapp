<?php

namespace App\Console\Commands;

use App\Enums\Chat\Campaign;
use App\Http\Controllers\ChatbotController;
use App\Models\Chat\MessageState;
use App\Models\StudentUniversity;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class VanderbiltCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:vanderbilt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load students matched with Vanderbilt and send post-match survey WhatsApp';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = StudentUniversity::getMatchesByUniversityID(77);
        echo 'Found ' . count($users) . ' users from Vanderbilt';
        Log::channel('chat')->info('Found ' . count($users) . ' users from Vanderbilt');
        foreach ($users as $user) {
            MessageState::queueCampaign($user['user_id'], Campaign::POSTMATCHINTENT, 3);
        }
        ChatbotController::startLoop();
        return Command::SUCCESS;
    }
}
