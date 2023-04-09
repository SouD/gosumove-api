<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Auth;

use App\Models\Auth\Token;
use Tests\TestCase;

class TokenTest extends TestCase
{
    public function test_it_can_be_created(): void
    {
        Token::factory()
            ->create();

        $this->assertDatabaseCount((new Token())->getTable(), 1);
    }
}
