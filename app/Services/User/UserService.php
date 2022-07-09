<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Models\User\User;
use App\Services\AbstractService as Service;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Carbon;

class UserService extends Service
{
    public function create(string $name, string $email, string $password, bool $isEmailVerified, EloquentCollection $roles): User
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'email_verified_at' => $isEmailVerified ? Carbon::now() : null,
        ]);

        if ($roles->isNotEmpty()) {
            $user->roles()
                ->attach($roles);
        }

        return $user;
    }
}
