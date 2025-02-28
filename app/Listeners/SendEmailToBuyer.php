<?php

namespace App\Listeners;

use App\Events\BuyerRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\BuyerWelcome;
use Illuminate\Support\Facades\Mail;

class SendEmailToBuyer
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
     * @param  \App\Events\BuyerRegister  $event
     * @return void
     */
    public function handle(BuyerRegister $event)
    {
        Mail::to($event->data['email'])->send(new BuyerWelcome($event->data));
    }
}
