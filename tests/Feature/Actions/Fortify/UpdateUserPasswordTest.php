<?php
declare(strict_types=1);

namespace Tests\Feature\Actions\Fortify;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User\User;
use Exception;
use Illuminate\Contracts\Hashing\Hasher;
use Tests\TestCase;

class UpdateUserPasswordTest extends TestCase
{
    public function test_it_updates_user_password(): void
    {
        $action = new UpdateUserPassword();
        $hasher = $this->app->make(Hasher::class);

        $oldPassword = $hasher->make('utveckla');

        $user = User::factory(1)
            ->create([
                'password' => $oldPassword,
            ])
            ->first();

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
        $hasher = $this->app->make(Hasher::class);

        $oldPassword = $hasher->make('utveckla');

        $user = User::factory(1)
            ->create([
                'password' => $oldPassword,
            ])
            ->first();

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
