<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\AgentRegister;
use App\Listeners\SendEmailToAgent;
use Illuminate\Auth\Events\Login;
use App\Listeners\LogLoginActivity;
use App\Events\BuyerRegister;
use App\Listeners\SendEmailToBuyer;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AgentRegister::class => [
            SendEmailToAgent::class
        ],
        BuyerRegister::class => [
            SendEmailToBuyer::class
        ],
        Login::class => [
            LogLoginActivity::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
