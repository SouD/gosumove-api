<?php
declare(strict_types=1);

namespace Tests\Feature\Http;

use Illuminate\Http\Response;
use Tests\TestCase;

class HealthzTest extends TestCase
{
    public function test_it_is_healthy(): void
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
