<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Auth\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::factory()
            ->all()
            ->create();
    }
}
