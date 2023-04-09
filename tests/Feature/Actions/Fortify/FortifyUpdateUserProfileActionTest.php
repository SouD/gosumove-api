<?php

declare(strict_types=1);

namespace Tests\Feature\Actions\Fortify;

use App\Actions\Fortify\UpdateUserProfileAction;
use App\Models\User\User;
use Tests\TestCase;

class FortifyUpdateUserProfileActionTest extends TestCase
{
    public function test_it_updates_user_password(): void
    {
        $action = $this->app->make(UpdateUserProfileAction::class);

        $user = User::factory()
            ->create();

        $oldName = $user->name;
        $oldEmail = $user->email;

        $action->update(
            user: $user,
            input: [
                'name' => 'Test Testsson',
                'email' => 'test.testsson@localhost',
            ]
        );

        $user->refresh();

        $this->assertNotEquals($oldName, $user->name);
        $this->assertNotEquals($oldEmail, $user->email);
        $this->assertNull($user->email_verified_at);
    }
}
