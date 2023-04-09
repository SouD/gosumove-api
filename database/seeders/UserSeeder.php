<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('user:create root root utveckla --verified --roles=root');

        User::factory(10)
            ->create();
    }
}
