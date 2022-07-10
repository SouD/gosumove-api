<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\Token;
use App\Models\User\Organization;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
    }

    /**
     * @return void
     */
    public function boot()
    {
        Relation::enforceMorphMap([
            'organization' => Organization::class,
            'permission' => Permission::class,
            'role' => Role::class,
            'token' => Token::class,
            'user' => User::class,
        ]);
    }
}
