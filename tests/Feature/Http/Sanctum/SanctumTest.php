<?php
declare(strict_types=1);

namespace Tests\Feature\Http\Sanctum;

use Tests\TestCase;

class SanctumTest extends TestCase
{
    public function test_it_gets_csrf_cookie(): void
    {
        $response = $this->get('/sanctum/csrf-cookie');

        $response->assertNoContent()
            ->assertCookie('XSRF-TOKEN');
    }
}
