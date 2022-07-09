<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Enums\Auth\RoleNameEnum;
use App\Models\Auth\Role;
use App\Services\AbstractService as Service;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class AuthService extends Service
{
    public function getDefaultRoles(): EloquentCollection
    {
        return Role::whereIn('name', [
            RoleNameEnum::USER,
        ])->get();
    }

    /**
     * @param array<int, string> $names
     */
    public function getRolesByNames(array $names): EloquentCollection
    {
        return Role::whereIn('name', $names)
            ->get();
    }
}
