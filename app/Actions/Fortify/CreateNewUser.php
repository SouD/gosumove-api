<?php
declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Jobs\User\UserCreateJob;
use App\Models\User\Organization;
use App\Models\User\User;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function __construct(public AuthService $authService)
    {
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     *
     * @return \App\Models\User\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'organization_name' => ['required', 'string', Rule::unique(Organization::class, 'name')],
        ])->validate();

        UserCreateJob::dispatchSync(
            organization: $input['organization_name'],
            name: $input['name'],
            email: $input['email'],
            password: $input['password'],
            isEmailVerified: false,
        );

        return User::firstWhere('email', $input['email']);
    }
}
