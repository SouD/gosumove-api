<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Auth\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::factory()
            ->all()
            ->create();
    }
}
