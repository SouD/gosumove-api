<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Fortify;

use App\Models\User\User;
use Tests\TestCase;

class FortifyTest extends TestCase
{
    public function test_it_logs_in_successfully(): void
    {
        $user = User::factory()
            ->create();

        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSuccessful();
    }
}
