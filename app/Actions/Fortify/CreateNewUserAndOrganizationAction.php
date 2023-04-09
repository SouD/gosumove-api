<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Actions\Organization\OrganizationCreateAction;
use App\Actions\User\UserCreateAction;
use App\Data\User\UserData;
use App\Models\User\User;
use Illuminate\Support\Arr;
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
        Arr::set($input, 'organization.name', Arr::get($input, 'organization.name', Arr::get($input, 'organization_name')));
        Arr::forget($input, 'organization_name');

        $data = UserData::validateAndCreate($input);

        return $this->userCreateAction->execute(
            data: $data,
            organization: $this->organizationCreateAction->execute(
                data: $data->organization
            )
        );
    }
}
