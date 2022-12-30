<?php
declare(strict_types=1);

namespace Tests\Feature\Http\Sanctum;

use App\Http\Middleware\TrustHosts;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class MiddlewareTrustHostsTest extends TestCase
{
    public function test_it_matches_hosts(): void
    {
        $middleware = $this->app->make(TrustHosts::class);

        $hosts = $middleware->hosts();

        $this->assertEquals(['^(.+\.)?' . Config::get('app.host') . '$'], $hosts);
    }
}
