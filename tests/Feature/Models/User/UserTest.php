<?php
declare(strict_types=1);

namespace Tests\Feature\Models\User;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Organization\Organization;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_it_can_be_created(): void
    {
        User::factory()
            ->create();

        $this->assertDatabaseCount((new User())->getTable(), 1);
    }

    public function test_it_has_relations(): void
    {
        $user = User::factory()
            ->has(Organization::factory(), 'organization')
            ->has(Permission::factory(1), 'permissions')
            ->has(Role::factory(1), 'roles')
            ->create();

        $this->assertInstanceOf(BelongsTo::class, $user->organization());
        $this->assertInstanceOf(BelongsToMany::class, $user->permissions());
        $this->assertInstanceOf(BelongsToMany::class, $user->roles());

        $this->assertNotNull($user->organization);
        $this->assertNotEmpty($user->permissions);
        $this->assertNotEmpty($user->roles);
    }

    public function test_it_has_resource_attribute()
    {
        $user = User::factory()
            ->create();

        $resourceAttribute = $user->getResourceAttribute();

        $this->assertSame($resourceAttribute, 'user'); // Same as morph class
    }
}
