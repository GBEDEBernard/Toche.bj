<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // Ici tu déclares tes commandes artisan
    protected $commands = [
        \App\Console\Commands\SendEventReminderEmails::class,
    ];

    // Ici tu planifies tes tâches
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('evenements:rappels')->dailyAt('08:00');
    }
}
