<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class notifyExistingStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to all existing students with link and temporary password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
