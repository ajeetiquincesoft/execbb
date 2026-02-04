<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send test email every minute';

    public function handle()
    {
        Mail::raw('This is cron test email', function ($message) {
            $message->to('santosh3257@gmail.com')
                ->subject('Cron Working - ' . now());
        });

        \Log::info('Cron executed at ' . now());
    }
}
