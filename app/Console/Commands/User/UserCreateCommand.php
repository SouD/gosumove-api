<?php
declare(strict_types=1);

namespace App\Console\Commands\User;

use App\Console\Commands\AbstractAutoValidatingCommand as Command;
use App\Jobs\User\UserCreateJob;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Rule;

class UserCreateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'user:create
                            {name : User name}
                            {password : User password}
                            {--email= : User email (default `name`@host if not specified)}
                            {--verified : User email verified or not}
                            {--role=* : Additional roles beyond the basics}';

    /**
     * @var string
     */
    protected $description = 'Create a user based on input arguments';

    public function handle(Hasher $hasher, Config $config): int
    {
        UserCreateJob::dispatchNow(
            $this->argument('name'),
            $this->option('email') ?: $this->argument('name') . '@' . $config->get('app.host'),
            $hasher->make($this->argument('password')),
            $this->option('verified'),
            $this->option('role') ?: [],
        );

        return 0;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('users', 'name')],
            'password' => ['required', 'string'],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')],
            'verified' => ['boolean'],
            'role' => ['nullable', 'array', 'min:1'],
            'role.*' => ['string', Rule::exists('roles', 'name')],
        ];
    }
}
