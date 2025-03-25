<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
        $currentDate = Carbon::now();
        $records = Listing::where('ExpDate', '<', $currentDate)
                            ->whereNotNull('ExpDate')
                            ->where('Status', '!=', 'expired')
                            ->get();

        foreach ($records as $record) {
            $record->Status = 'expired';
            $record->save();
            $this->info('Record ' . $record->id . ' updated to expired');
        }

        $this->info('All expired records have been updated.');
        try {
            /* Mail::raw('The cron job has successfully run and updated expired listings.', function ($message) {
                $message->to('santosh3257@gmail.com')
                        ->subject('Test Cron Job Notification');
            });

            $this->info('Test email sent successfully.'); */
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
        }
    }
}
