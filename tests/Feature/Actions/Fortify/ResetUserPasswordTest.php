<?php
declare(strict_types=1);

namespace Tests\Feature\Actions\Fortify;

use App\Actions\Fortify\ResetUserPassword;
use App\Models\User\User;
use Illuminate\Contracts\Hashing\Hasher;
use Tests\TestCase;

class ResetUserPasswordTest extends TestCase
{
    public function test_it_resets_user_password(): void
    {
        $action = new ResetUserPassword();
        $hasher = $this->app->make(Hasher::class);

        $oldPassword = $hasher->make('utveckla');

        $user = User::factory()
            ->create([
                'password' => $oldPassword,
            ]);

        $action->reset(
            user: $user,
            input: [
                'password' => 'utveckla2',
                'password_confirmation' => 'utveckla2',
            ]
        );

        $user->refresh();

        $this->assertNotEquals($oldPassword, $user->password);
    }
}
