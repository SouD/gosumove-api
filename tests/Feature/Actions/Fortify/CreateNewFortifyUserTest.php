<?php
declare(strict_types=1);

namespace Tests\Feature\Actions\Fortify;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User\Organization;
use Tests\TestCase;

class CreateNewFortifyUserTest extends TestCase
{
    public function test_it_creates_user(): void
    {
        $action = new CreateNewUser();

        $user = $action->create([
            'name' => 'Test Testsson',
            'email' => 'test+gosumove-api@lando.site',
            'password' => 'utveckla',
            'password_confirmation' => 'utveckla',
            'organization_id' => Organization::factory(1)->create()->first()->id,
        ]);

        $this->assertModelExists($user);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'email' => 'test+gosumove-api@lando.site',
        ]);
    }
}
