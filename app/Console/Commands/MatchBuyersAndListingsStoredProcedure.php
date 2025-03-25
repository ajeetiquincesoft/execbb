<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

            // Success message
            $this->info('Stored procedure executed successfully!');
        } catch (\Exception $e) {
            // Error handling
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
