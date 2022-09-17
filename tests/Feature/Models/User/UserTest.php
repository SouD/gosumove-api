<?php
declare(strict_types=1);

namespace Tests\Feature\Models\User;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\User\Organization;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_it_has_relations(): void
    {
        $user = User::factory(1)
            ->has(Organization::factory(1), 'organization')
            ->has(Permission::factory(1), 'permissions')
            ->has(Role::factory(1), 'roles')
            ->create()
            ->first();

        $this->assertInstanceOf(BelongsTo::class, $user->organization());
        $this->assertInstanceOf(BelongsToMany::class, $user->permissions());
        $this->assertInstanceOf(BelongsToMany::class, $user->roles());

        $this->assertNotNull($user->organization);
        $this->assertNotEmpty($user->permissions);
        $this->assertNotEmpty($user->roles);
    }
}
