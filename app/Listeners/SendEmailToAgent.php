<?php

namespace App\Listeners;

use App\Events\AgentRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\AgentWelcome;
use Illuminate\Support\Facades\Mail;

class SendEmailToAgent
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
     * @param  \App\Events\AgentRegister  $event
     * @return void
     */
    public function handle(AgentRegister $event)
    {
        $email = $event->email;
         Mail::to($email)->send(new AgentWelcome());
    }
}
