<?php
declare(strict_types=1);

namespace Database\Factories\User;

use App\Enums\Auth\PermissionNameEnum;
use App\Enums\Auth\RoleNameEnum;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()
                ->safeEmail(),
            'email_verified_at' => Carbon::now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'logins' => $this->faker->randomDigit(),
            'last_login_at' => Carbon::now(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()
                ->attach(Role::where('name', RoleNameEnum::USER)->first());
            $user->permissions()
                ->attach(Permission::where('name', PermissionNameEnum::AUTH_LOGIN)->first());
        });
    }
}
