<?php
declare(strict_types=1);

namespace Tests\Feature\Http\Local;

use Tests\TestCase;

class LocalControllerTest extends TestCase
{
    public function test_it_get_csrf_token(): void
    {
        $response = $this->get('/_local/csrf-token');

        $response->assertOk();
    }
}
