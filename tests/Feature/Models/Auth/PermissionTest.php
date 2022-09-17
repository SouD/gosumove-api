<?php
declare(strict_types=1);

namespace Tests\Feature\Models\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    public function test_it_has_relations(): void
    {
        $permission = Permission::factory(1)
            ->has(Role::factory(1), 'roles')
            ->create()
            ->first();

        $this->assertInstanceOf(BelongsToMany::class, $permission->roles());

        $this->assertNotEmpty($permission->roles);
    }
}
