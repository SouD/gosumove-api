<?php
declare(strict_types=1);

namespace App\Jobs\User;

use App\Jobs\AbstractJob as Job;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Support\Collection;

class UserCreateJob extends Job
{
    public function __construct(
        public string $organization,
        public string $name,
        public string $email,
        public string $password,
        public bool $isEmailVerified,
        public array|Collection $roleNames = [],
    ) {
    }

    public function handle(AuthService $authService, UserService $userService): void
    {
        $roles = $authService->getDefaultRoles();
        $roleNames = Collection::make($this->roleNames);

        if ($roleNames->isNotEmpty()) {
            $roles = $roles->merge($authService->getRolesByNames($roleNames));
        }

        $userService->create(
            organization: $userService->getOrganizationByName($this->organization, true),
            name: $this->name,
            email: $this->email,
            password: $this->password,
            isEmailVerified: $this->isEmailVerified,
            roles: $roles
        );
    }
}
