<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Actions\Organization\OrganizationCreateAction;
use App\Actions\User\UserCreateAction;
use App\Data\User\UserData;
use App\Models\User\User;
use Laravel\Fortify\Contracts\CreatesNewUsers as CreatesNewUsersContract;

class CreateNewUserAndOrganizationAction implements CreatesNewUsersContract
{
    public function __construct(
        public OrganizationCreateAction $organizationCreateAction,
        public UserCreateAction $userCreateAction
    ) {
    }

    public function execute(UserData $data): User
    {
        return $this->create($data->toArray());
    }

    /**
     * Validate and create a newly registered user.
     *
     *
     * @return \App\Models\User\User
     */
    public function create(array $input)
    {
        $data = UserData::validateAndCreate($input);

        return $this->userCreateAction->execute(
            data: $data,
            organization: $this->organizationCreateAction->execute(
                data: $data->organization
            )
        );
    }
}
