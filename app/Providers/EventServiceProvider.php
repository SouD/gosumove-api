<?php
declare(strict_types=1);

namespace App\Providers;

use App\Listeners\User\UserLoginListener;
use Illuminate\Auth\Events\Login as UserLoginEvent;
use Illuminate\Auth\Events\Registered as UserRegisteredEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification as UserSendEmailVerificationNotificationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserRegisteredEvent::class => [
            UserSendEmailVerificationNotificationListener::class,
        ],
        UserLoginEvent::class => [
            UserLoginListener::class,
        ],
    ];

    /**
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
