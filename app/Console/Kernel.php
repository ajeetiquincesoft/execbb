<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateStatus;
use App\Console\Commands\MatchBuyersAndListingsStoredProcedure;

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
        // $schedule->command('inspire')->hourly();
        $schedule->command(UpdateStatus::class)->dailyAt('00:00')->timezone('Asia/Kolkata')->withoutOverlapping();
        $schedule->command(MatchBuyersAndListingsStoredProcedure::class)->dailyAt('00:00')->timezone('Asia/Kolkata')->withoutOverlapping();
        /* $schedule->command('email:test')->everyMinute(); */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
