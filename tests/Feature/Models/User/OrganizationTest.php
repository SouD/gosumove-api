<?php

declare(strict_types=1);

namespace Tests\Feature\Models\User;

use App\Models\Organization\Organization;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    public function test_it_can_be_created(): void
    {
        Organization::factory()
            ->create();

        $this->assertDatabaseCount((new Organization())->getTable(), 1);
    }

    public function test_it_has_relations(): void
    {
        $organization = Organization::factory()
            ->has(User::factory(1), 'users')
            ->create();

        $this->assertInstanceOf(HasMany::class, $organization->users());

        $this->assertNotEmpty($organization->users);
    }

    public function test_it_has_resource_attribute()
    {
        $organization = Organization::factory()
            ->create();

        $resourceAttribute = $organization->getResourceAttribute();

        $this->assertSame($resourceAttribute, 'organization'); // Same as morph class
    }
}
