<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Enums\Auth\RoleNameEnum;
use App\Models\Auth\Role;
use App\Models\User\Organization;
use App\Models\User\User;
use App\Services\AbstractService as Service;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Laravel\Sanctum\NewAccessToken;

class AuthService extends Service
{
    public function getDefaultRoles(): EloquentCollection
    {
        return Role::whereIn('name', [
            RoleNameEnum::USER,
        ])->get();
    }

    /**
     * @param array<int, string>|Collection<int, string> $names
     */
    public function getRolesByNames(array|Collection $names): EloquentCollection
    {
        return Role::whereIn('name', $names)
            ->get();
    }

    public function createToken(Organization|User $model, string $name, EloquentCollection $permissions): NewAccessToken
    {
        return $model->createToken(
            name: $name,
            abilities: $permissions->isEmpty()
                ? ['*']
                : $permissions->pluck('name')->all()
        );
    }
}
