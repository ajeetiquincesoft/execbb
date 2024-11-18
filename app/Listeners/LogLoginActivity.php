<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Request;

class LogLoginActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
       // dd(request()->header('User-Agent'));
         // Create a new login activity record
         LoginActivity::create([
            'user_id' => $event->user->id,
            'ip_address' => Request::ip(),
            'user_info' => request()->header('User-Agent'),
            'logged_in_at' => now(),
        ]);
    }
}
