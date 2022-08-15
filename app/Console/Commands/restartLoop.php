<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class restartLoop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:restartLoop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload chat tables for testing and start test loop';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
