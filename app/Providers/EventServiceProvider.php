<?php

namespace App\Providers;

use App\Listeners\Notifications\RecordNotificationFailed;
use App\Listeners\Notifications\RecordNotificationSending;
use App\Listeners\Notifications\RecordNotificationSent;
use App\Models\Client;
use App\Models\Estate;
use App\Observers\ClientObserver;
use App\Observers\EstateObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Notifications\Events\NotificationSent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NotificationSending::class => [
            RecordNotificationSending::class,
        ],
        NotificationSent::class => [
            RecordNotificationSent::class,
        ],
        NotificationFailed::class => [
            RecordNotificationFailed::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Client::observe(ClientObserver::class);
        Estate::observe(EstateObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
