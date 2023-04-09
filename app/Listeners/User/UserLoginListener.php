<?php

declare(strict_types=1);

namespace App\Listeners\User;

use App\Listeners\AbstractListener as Listener;
use App\Models\User\User;
use Illuminate\Auth\Events\Login as UserLoginEvent;

class UserLoginListener extends Listener
{
    public function handle(UserLoginEvent $event): void
    {
        /**
         * @var User $user
         */
        $user = $event->user;
    }
}
