<?php

namespace App\Providers;

use App\Events\MatterClaimCollected;
use App\Listeners\MatterClaimUpdateStatus;
use App\Models\Matter;
use App\Observers\MatterObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        MatterClaimCollected::class => [
            MatterClaimUpdateStatus::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Matter::observe(MatterObserver::class);
    }
}
