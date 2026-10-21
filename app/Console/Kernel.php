<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Hébergement mutualisé : pas de worker permanent. Le cron unique
        // "* * * * * php artisan schedule:run" vide la file d'attente (SMS en masse) chaque minute.
        $schedule->command('queue:work --stop-when-empty --max-time=55 --tries=1')
            ->everyMinute()
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
