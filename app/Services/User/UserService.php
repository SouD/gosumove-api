<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Models\User\Organization;
use App\Models\User\User;
use App\Services\AbstractService as Service;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Carbon;

class UserService extends Service
{
    public function create(Organization $organization, string $name, string $email, string $password, bool $isEmailVerified, EloquentCollection $roles): User
    {
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'email_verified_at' => $isEmailVerified ? Carbon::now() : null,
        ]);

        $user->organization()
            ->associate($organization);

        $user->save();

        if ($roles->isNotEmpty()) {
            $user->roles()
                ->attach($roles);
        }

        return $user;
    }

    public function getOrganization(string $name, bool $createIfNotFound = false): ?Organization
    {
        if ($createIfNotFound) {
            return Organization::firstOrCreate(['name' => $name]);
        }

        return Organization::where('name', $name)
            ->first();
    }
}
