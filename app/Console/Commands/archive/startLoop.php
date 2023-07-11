<?php

namespace App\Console\Commands\archive;

use App\Http\Controllers\ChatbotController;
use Illuminate\Console\Command;

class startLoop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts the loop in the WhatsApp Chatbot Controller';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ChatbotController::startLoop();
        return self::SUCCESS;
    }
}
