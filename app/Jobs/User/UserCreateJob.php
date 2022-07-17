<?php
declare(strict_types=1);

namespace App\Jobs\User;

use App\Jobs\AbstractJob as Job;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;

class UserCreateJob extends Job
{
    public function __construct(
        public string $organization,
        public string $name,
        public string $email,
        public string $password,
        public bool $isEmailVerified,
        public array $roleNames,
    ) {
    }

    public function handle(AuthService $authService, UserService $userService): void
    {
        $userService->create(
            organization: $userService->getOrganizationByName($this->organization, true),
            name: $this->name,
            email: $this->email,
            password: $this->password,
            isEmailVerified: $this->isEmailVerified,
            roles: $authService->getDefaultRoles()
                ->merge($authService->getRolesByNames($this->roleNames))
        );
    }
}
