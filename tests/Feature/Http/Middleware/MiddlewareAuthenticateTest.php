<?php
declare(strict_types=1);

namespace Tests\Feature\Http\Middleware;

use App\Http\Middleware\Authenticate;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Organization\Organization;
use App\Models\User\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Tests\TestCase;

class MiddlewareAuthenticateTest extends TestCase
{
    public function test_it_passes_authentication(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()
            ->has(Organization::factory(), 'organization')
            ->has(Permission::factory(1), 'permissions')
            ->has(Role::factory(1), 'roles')
            ->create();

        $this->actingAs($user);

        $request = $this->app->make(Request::class);
        $middleware = $this->app->make(Authenticate::class);
        $error = null;

        try {
            $middleware->handle($request, fn () => null);
        } catch (AuthenticationException $e) {
            $error = $e;
        }

        $this->assertNull($error);
    }

    public function test_it_fails_authentication(): void
    {
        $request = $this->app->make(Request::class);
        $middleware = $this->app->make(Authenticate::class);
        $error = null;

        try {
            $middleware->handle($request, fn () => null);

            throw new Exception('Authentication did not fail but was expected to fail.');
        } catch (AuthenticationException $e) {
            $error = $e;
        }

        $this->assertNotNull($error);
    }

    // TODO: Test redirects
}
