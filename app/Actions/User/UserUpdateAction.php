<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\AbstractAction as Action;
use App\Data\User\UserData;
use App\Models\Organization\Organization;
use App\Models\User\User;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Spatie\QueueableAction\QueueableAction;

class UserUpdateAction extends Action
{
    use QueueableAction;

    public function execute(User $user, UserData $data, ?Organization $organization): User
    {
        $oldEmail = $user->email;

        if ($organization) {
            $user->organization()
                ->associate($organization);
        }

        if ($oldEmail !== $data->email && $user instanceof MustVerifyEmailContract) {
            $user->forceFill(\array_merge($data->toArray(), ['email_verified_at' => null]))
                ->save();

            $user->sendEmailVerificationNotification();
        } else {
            $user->fill($data->toArray())
                ->save();
        }

        return $user;
    }
}
