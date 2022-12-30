<?php
declare(strict_types=1);

namespace Tests\Feature\Actions\Fortify;

use App\Actions\Fortify\CreateNewUser;
use Tests\TestCase;

class CreateNewFortifyUserTest extends TestCase
{
    public function test_it_creates_user(): void
    {
        $action = $this->app->make(CreateNewUser::class);

        $user = $action->create([
            'name' => 'Test Testsson',
            'email' => 'test.testsson@localhost',
            'password' => 'utveckla',
            'password_confirmation' => 'utveckla',
            'organization_name' => 'Test AB',
        ]);

        $this->assertModelExists($user);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'email' => 'test.testsson@localhost',
        ]);
    }
}
