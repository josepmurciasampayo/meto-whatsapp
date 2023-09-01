<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class FixPermissions extends Command
{
    protected $signature = 'app:fix-permissions';

    protected $description = 'Command description';

    public function handle()
    {
        Process::run('. permissions.sh');
    }
}
