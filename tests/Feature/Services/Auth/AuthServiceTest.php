<?php
declare(strict_types=1);

namespace Tests\Feature\Services\Auth;

use App\Enums\Auth\PermissionNameEnum;
use App\Enums\Auth\RoleNameEnum;
use App\Models\User\Organization;
use App\Models\User\User;
use App\Services\Auth\AuthService;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function test_it_gets_default_role_names(): void
    {
        $this->seed(RoleSeeder::class);

        $authService = $this->app->make(AuthService::class);
        $defaultRoleNames = $authService->getDefaultRoleNames();

        $this->assertTrue($defaultRoleNames->isNotEmpty());
        $this->assertEquals($defaultRoleNames->count(), count(Config::get('app.services.auth.default_roles')));
    }

    public function test_it_gets_default_roles(): void
    {
        $this->seed(RoleSeeder::class);

        $authService = $this->app->make(AuthService::class);
        $defaultRoles = $authService->getDefaultRoles();

        $this->assertTrue($defaultRoles->isNotEmpty());
        $this->assertEquals($defaultRoles->count(), $authService->getDefaultRoleNames()->count());
    }

    public function test_it_gets_roles_by_names(): void
    {
        $this->seed(RoleSeeder::class);

        $authService = $this->app->make(AuthService::class);
        $roleNames = [RoleNameEnum::ROOT];
        $rolesByNames = $authService->getRolesByNames($roleNames);

        $this->assertTrue($rolesByNames->isNotEmpty());
        $this->assertEquals($rolesByNames->count(), count($roleNames));
    }

    public function test_it_creates_token(): void
    {
        $authService = $this->app->make(AuthService::class);

        $organization = Organization::factory()
            ->create();

        $token = $authService->createToken(
            model: $organization,
            name: 'test',
            permissions: Collection::make([]),
        );

        $this->assertEquals($token->accessToken->tokenable_id, $organization->id);
    }

    public function test_it_has_permissions(): void
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);

        $authService = $this->app->make(AuthService::class);

        $user = User::factory()
            ->create();

        $outcome = $authService->hasPermission(
            model: $user,
            permissionName: PermissionNameEnum::AUTH_LOGIN,
        );

        $this->assertTrue($outcome);

        $outcome = $authService->hasPermission(
            model: $user,
            permissionName: 'auth.login',
        );

        $this->assertTrue($outcome);

        $outcome = $authService->hasPermission(
            model: $user,
            permissionName: 'non_existing_permission',
        );

        $this->assertFalse($outcome);
    }
}
