<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;
use Carbon\Carbon;

class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status to "expired and valid" for listing records whose expiration date is past the current date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = Carbon::now(); // Get current date
        $records = Listing::where('ExpDate', '<', $currentDate)
                            ->whereNotNull('ExpDate')
                            ->where('Status', '!=', 'expired')
                            ->get();

        foreach ($records as $record) {
            $record->Status = 'expired';
            $record->Active = 0;
            $record->save();
            $this->info('Record ' . $record->id . ' updated to expired');
        }

        $this->info('All expired records have been updated.');
    }
}
