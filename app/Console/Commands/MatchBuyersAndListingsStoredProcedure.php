<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MatchBuyersAndListingsStoredProcedure extends Command
{
    // The name and signature of the console command.
    protected $signature = 'call:daily-stored-procedure';

    // The console command description.
    protected $description = 'Call the daily stored procedure in MySQL';

    // Create a new command instance.
    public function __construct()
    {
        parent::__construct();
    }

    // Execute the console command.
    public function handle()
    {
        try {
            // Call your stored procedure here
            DB::statement('CALL MatchBuyersAndListings()');  // Replace with your stored procedure name
            Mail::raw('The cron job has successfully run and updated expired listings.', function ($message) {
                $message->to('santosh3257@gmail.com')
                        ->subject('Test Cron Job Notification');
            });
            // Success message
            $this->info('Stored procedure executed successfully!');
        } catch (\Exception $e) {
            // Error handling
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
