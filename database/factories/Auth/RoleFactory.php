<?php
declare(strict_types=1);

namespace Database\Factories\Auth;

use App\Enums\Auth\PermissionNameEnum;
use App\Enums\Auth\RoleNameEnum;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auth\Role>
 */
class RoleFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => RoleNameEnum::USER,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Role $role) {
            $role->permissions()
                ->attach(Permission::whereIn('name', $this->getPermissionNamesFor($role))->get());
        });
    }

    public function all(): static
    {
        $cases = Collection::make(RoleNameEnum::all())
            ->pluck('value')
            ->map(fn ($value, $key) => ['name' => $value]);

        return $this->count($cases->count())
            ->state(new Sequence(...$cases->all()));
    }

    public function getPermissionNamesFor(Role $role): array
    {
        return match ($role->name) {
            default => [
                PermissionNameEnum::AUTH_TOKEN_CREATE,
                PermissionNameEnum::AUTH_TOKEN_DELETE,
            ],
        };
    }
}
