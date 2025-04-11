<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\CheckOverdueMedications::class,
        \App\Console\Commands\SendMedicationReminders::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule tasks here
        $schedule->command('medications:check-overdue')->hourly();
        $schedule->command('medications:send-reminders')->dailyAt('08:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
