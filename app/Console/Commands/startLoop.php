<?php

namespace App\Console\Commands;

use App\Http\Controllers\ChatbotController;
use Illuminate\Console\Command;

class startLoop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:startLoop';

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
        return 0;
    }
}
