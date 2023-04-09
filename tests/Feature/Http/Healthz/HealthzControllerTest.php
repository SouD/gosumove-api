<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Healthz;

use Tests\TestCase;

class HealthzControllerTest extends TestCase
{
    public function test_it_is_healthy(): void
    {
        $response = $this->get('/');

        $response->assertNoContent();
    }
}
