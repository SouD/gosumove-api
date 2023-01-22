<?php
declare(strict_types=1);

namespace Tests\Feature\Actions\Fortify;

use App\Actions\Fortify\CreateNewUserAndOrganizationAction;
use Tests\TestCase;

class FortifyCreateNewUserAndOrganizationActionTest extends TestCase
{
    public function test_it_creates_user(): void
    {
        $action = $this->app->make(CreateNewUserAndOrganizationAction::class);

        $user = $action->create([
            'name' => 'Test Testsson',
            'email' => 'test.testsson@localhost',
            'password' => 'utveckla',
            'password_confirmation' => 'utveckla',
            'organization' => [
                'name' => 'Test AB',
            ],
        ]);

        $this->assertModelExists($user);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'email' => 'test.testsson@localhost',
        ]);
    }
}
