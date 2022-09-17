<?php
declare(strict_types=1);

namespace Tests\Feature\Models\User;

use App\Models\User\Organization;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    public function test_it_has_relations(): void
    {
        $organization = Organization::factory(1)
            ->has(User::factory(1), 'users')
            ->create()
            ->first();

        $this->assertInstanceOf(HasMany::class, $organization->users());

        $this->assertNotEmpty($organization->users);
    }
}
