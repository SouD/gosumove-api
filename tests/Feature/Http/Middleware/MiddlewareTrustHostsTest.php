<?php
declare(strict_types=1);

namespace Tests\Feature\Http\Sanctum;

use App\Http\Middleware\TrustHosts;
use Tests\TestCase;

class MiddlewareTrustHostsTest extends TestCase
{
    public function test_it_matches_hosts(): void
    {
        $middleware = $this->app->make(TrustHosts::class);

        $hosts = $middleware->hosts();

        $this->assertEquals($hosts, ['^(.+\.)?localhost$']);
    }
}
