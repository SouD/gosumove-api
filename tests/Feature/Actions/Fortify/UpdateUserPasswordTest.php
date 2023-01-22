<?php
declare(strict_types=1);

namespace Tests\Feature\Actions\Fortify;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User\User;
use Exception;
use Tests\TestCase;

class UpdateUserPasswordTest extends TestCase
{
    public function test_it_updates_user_password(): void
    {
        $action = new UpdateUserPassword();
        $user = User::factory()
            ->create([
                'password' => 'utveckla',
            ]);
        $oldPassword = $user->password;

        $action->update(
            user: $user,
            input: [
                'current_password' => 'utveckla',
                'password' => 'utveckla2',
                'password_confirmation' => 'utveckla2',
            ]
        );

        $user->refresh();

        $this->assertNotEquals($oldPassword, $user->password);
    }

    public function test_it_fails_to_update_user_password(): void
    {
        $action = new UpdateUserPassword();
        $user = User::factory()
            ->create([
                'password' => 'utveckla',
            ]);
        $oldPassword = $user->password;

        try {
            $action->update(
                user: $user,
                input: [
                    'current_password' => 'utveckla1',
                    'password' => 'utveckla2',
                    'password_confirmation' => 'utveckla2',
                ]
            );
        } catch (Exception $e) {
        }

        $user->refresh();

        $this->assertEquals($oldPassword, $user->password);
    }
}
