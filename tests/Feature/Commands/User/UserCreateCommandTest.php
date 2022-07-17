<?php
declare(strict_types=1);

namespace Tests\Feature\Commands\User;

use App\Jobs\User\UserCreateJob;
use App\Models\Auth\Role;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class UserCreateCommandTest extends TestCase
{
    public function test_it_creates_a_user(): void
    {
        Bus::fake();

        $role = Role::factory()
            ->create();

        $this->artisan('user:create "Test Ltd" "Test Testsson" password --email=test@localhost --verified --role=' . $role->name->value)
            ->assertExitCode(0);

        Bus::assertDispatchedSync(UserCreateJob::class);
    }
}
