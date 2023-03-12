<?php
declare(strict_types=1);

namespace Tests\Feature\Models\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    public function test_it_can_be_created(): void
    {
        Permission::factory()
            ->create();

        $this->assertDatabaseCount((new Permission())->getTable(), 1);
    }

    public function test_it_has_relations(): void
    {
        $permission = Permission::factory()
            ->has(Role::factory(1), 'roles')
            ->create();

        $this->assertInstanceOf(BelongsToMany::class, $permission->roles());

        $this->assertNotEmpty($permission->roles);
    }

    public function test_it_has_resource_attribute()
    {
        $permission = Permission::factory()
            ->create();

        $resourceAttribute = $permission->getResourceAttribute();

        $this->assertSame($resourceAttribute, 'permission'); // Same as morph class
    }
}
