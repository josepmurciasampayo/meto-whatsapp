<?php

namespace App\Console\Commands\archive;

use App\Enums\Chat\Campaign;
use App\Helpers;
use App\Http\Controllers\ChatbotController;
use App\Models\Chat\MessageState;
use Illuminate\Console\Command;

class batchChatCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:batch {count} {campaign_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select random subset of eligible students for chat campaign and initiates it';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->argument('count');
        $campaign_id = $this->argument('campaign_id');

        $students = Helpers::dbQueryArray('
            SELECT u1.id as user_id, u1.first, u1.last, u1.email, u1.phone_raw
            FROM meto_users AS u1
            join meto_students as s on s.user_id = u1.id
            join meto_student_universities as su on s.id = su.student_id
            JOIN (
                SELECT u2.id
                FROM meto_users as u2
                left outer join meto_message_states as m on m.user_id = u2.id and m.message_id = ' . $campaign_id . '
                where u2.role=2 and u2.phone_whatsapp_valid=2 and m.user_id is null and u2.phone_unique = 1
                ORDER BY RAND()
                LIMIT ' . $count . '
                ) as j1 ON u1.id=j1.id
            group by user_id;
        ');

        foreach ($students as $student) {
            $campaign = Campaign::from($this->argument('campaign_id'));
            MessageState::queueCampaign($student['user_id'], $campaign);
        }

        ChatbotController::startLoop();
        return Command::SUCCESS;
    }
}
