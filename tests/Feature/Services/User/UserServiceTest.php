<?php
declare(strict_types=1);

namespace Tests\Feature\Services\User;

use App\Models\Auth\Role;
use App\Models\User\Organization;
use App\Services\User\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function test_it_creates_a_user(): void
    {
        $userService = $this->app->make(UserService::class);

        $roles = Role::factory(1)
            ->create();
        $organization = Organization::factory()
            ->create();

        $user = $userService->create(
            organization: $organization,
            name: 'Test Testsson',
            email: 'verified@localhost',
            password: 'utveckla',
            isEmailVerified: true,
            roles: Role::all(),
        );

        $this->assertEquals($user->name, 'Test Testsson');
        $this->assertEquals($user->email, 'verified@localhost');
        $this->assertNotNull($user->email_verified_at);
        $this->assertEquals($user->organization->id, $organization->id);
        $this->assertEquals($user->roles->count(), $roles->count());

        $user = $userService->create(
            organization: $organization,
            name: 'Test Testsson',
            email: 'not.verified@localhost',
            password: 'utveckla',
            isEmailVerified: false,
            roles: Role::all(),
        );

        $this->assertEquals($user->email, 'not.verified@localhost');
        $this->assertNull($user->email_verified_at);
    }

    public function test_it_gets_organization_by_name(): void
    {
        $organization = Organization::factory()
            ->create();

        $userService = $this->app->make(UserService::class);

        $organizationFound = $userService->getOrganizationByName(
            name: $organization->name,
            createIfNotFound: false,
        );

        $this->assertNotNull($organizationFound);
        $this->assertEquals($organization->id, $organizationFound->id);
        $this->assertEquals($organization->name, $organizationFound->name);

        $organization = $userService->getOrganizationByName(
            name: 'Non existing org name',
            createIfNotFound: true,
        );

        $this->assertNotNull($organization);
        $this->assertEquals($organization->name, 'Non existing org name');

        $organization = $userService->getOrganizationByName(
            name: 'Non existing org name 2',
            createIfNotFound: false,
        );

        $this->assertNull($organization);
    }
}
