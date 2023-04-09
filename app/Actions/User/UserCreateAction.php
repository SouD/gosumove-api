<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\AbstractAction as Action;
use App\Data\User\UserData;
use App\Models\Organization\Organization;
use App\Models\User\User;
use Spatie\QueueableAction\QueueableAction;

class UserCreateAction extends Action
{
    use QueueableAction;

    public function execute(UserData $data, Organization $organization): User
    {
        $user = new User([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        $user->organization()
            ->associate($organization);

        $user->save();

        return $user;
    }
}
