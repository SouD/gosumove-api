<?php
declare(strict_types=1);

namespace Tests\Feature\Jobs\User;

use App\Enums\Auth\RoleNameEnum;
use App\Jobs\User\UserCreateJob;
use App\Models\User\Organization;
use Database\Seeders\RoleSeeder;
use Tests\TestCase;

class UserCreateJobTest extends TestCase
{
    public function test_it_creates_a_user(): void
    {
        $this->seed(RoleSeeder::class);

        $organization = Organization::factory()
            ->create();
        $job = new UserCreateJob(
            organization: $organization->name,
            name: 'Test Testsson',
            email: 'test@localhost',
            password: 'test',
            isEmailVerified: true,
            roleNames: [RoleNameEnum::ROOT],
        );

        $this->app->call([$job, 'handle']);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'name' => 'Test Testsson',
            'email' => 'test@localhost',
        ]);
    }
}
