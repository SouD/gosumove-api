<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Actions\User\UserUpdateAction;
use App\Data\User\UserData;
use App\Models\User\User;
use Illuminate\Support\Arr;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation as UpdatesUserProfileInformationContract;

class UpdateUserProfileAction implements UpdatesUserProfileInformationContract
{
    public function __construct(
        public UserUpdateAction $userUpdateAction
    ) {
    }

    public function execute(User $user, UserData $data): User
    {
        return $this->update($user, $data->toArray());
    }

    public function update(User $user, array $input): User
    {
        $data = UserData::validateAndCreate(Arr::only($input, ['name', 'email']));

        return $this->userUpdateAction->execute(
            user: $user,
            data: $data,
            organization: null
        );
    }
}
