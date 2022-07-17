<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\Auth\Role;
use App\Models\User\Organization;
use App\Models\User\User;
use App\Services\AbstractService as Service;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Laravel\Sanctum\NewAccessToken;

class AuthService extends Service
{
    public function __construct(
        protected Config $config
    ) {
    }

    public function getDefaultRoleNames(): Collection
    {
        return Collection::make($this->config->get('app.services.auth.default_roles'));
    }

    public function getDefaultRoles(): EloquentCollection
    {
        return $this->getRolesByNames($this->getDefaultRoleNames());
    }

    /**
     * @param array<int, string>|Collection<int, string> $names
     */
    public function getRolesByNames(array|Collection $names): EloquentCollection
    {
        return Role::whereIn('name', $names)
            ->get();
    }

    public function createToken(Organization|User $model, string $name, Collection $permissions): NewAccessToken
    {
        return $model->createToken(
            name: $name,
            abilities: $permissions->isEmpty()
                ? ['*']
                : $permissions->pluck('name')->all()
        );
    }
}
