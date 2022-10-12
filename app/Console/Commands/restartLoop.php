<?php

namespace App\Console\Commands;

use App\Http\Controllers\ChatbotController;
use App\Models\Chat\MessageState;
use App\Models\LogComms;
use App\Models\Matches;
use Database\Seeders\ChatTestSeeder;
use Illuminate\Console\Command;

class restartLoop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:restartLoop {createUsers=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload chat tables for testing and start test loop';

    /**
     * Dump the relevant tables, reload them with the chat test seeder, and restart the loop
     *
     * @return int
     */
    public function handle()
    {
        MessageState::truncate();
        LogComms::truncate();
        $seeder = new ChatTestSeeder();
        $seeder->run($this->argument('createUsers'));
        ChatbotController::startLoop();
        return 0;
    }
}
