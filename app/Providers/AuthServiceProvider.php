<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\Auth\Token;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * @return void
     */
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(Token::class);
    }
}
