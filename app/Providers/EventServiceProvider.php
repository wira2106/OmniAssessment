<?php

namespace App\Providers;

use App\Events\CreateTokenUserEvent;
use App\Events\SendEmailUserEvent;
use App\Listeners\CreateTokenUserListener;
use App\Listeners\SendEmailUserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendEmailUserEvent::class => [
            SendEmailUserListener::class,
        ],
        CreateTokenUserEvent::class => [
            CreateTokenUserListener::class,
        ]
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
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
