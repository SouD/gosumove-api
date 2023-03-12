<?php
declare(strict_types=1);

namespace Tests\Feature\Models\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function test_it_can_be_created(): void
    {
        Role::factory()
            ->create();

        $this->assertDatabaseCount((new Role())->getTable(), 1);
    }

    public function test_it_has_relations(): void
    {
        $role = Role::factory()
            ->has(Permission::factory(1), 'permissions')
            ->create();

        $this->assertInstanceOf(BelongsToMany::class, $role->permissions());

        $this->assertNotEmpty($role->permissions);
    }

    public function test_it_has_resource_attribute()
    {
        $role = Role::factory()
            ->create();

        $resourceAttribute = $role->getResourceAttribute();

        $this->assertSame($resourceAttribute, 'role'); // Same as morph class
    }
}
