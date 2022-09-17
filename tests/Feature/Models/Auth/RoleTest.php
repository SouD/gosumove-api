<?php
declare(strict_types=1);

namespace Tests\Feature\Models\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function test_it_has_relations(): void
    {
        $role = Role::factory(1)
            ->has(Permission::factory(1), 'permissions')
            ->create()
            ->first();

        $this->assertInstanceOf(BelongsToMany::class, $role->permissions());

        $this->assertNotEmpty($role->permissions);
    }
}
