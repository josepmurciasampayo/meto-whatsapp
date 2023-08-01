<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // to add to cron job:
        // * * * * * cd /var/www/meto-???? && php artisan schedule:run >> /dev/null 2>&1
        //$schedule->command('command:startLoop')->everyMinute();
        $schedule->command('backup:run')->daily()->at('11:30');
        $schedule->command('import:google')->hourly();
        $schedule->exec('. permissions.sh')->hourly();
        //$schedule->command('verify:whatsapp')->everyMinute()->withoutOverlapping()->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
