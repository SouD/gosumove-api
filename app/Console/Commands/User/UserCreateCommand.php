<?php
declare(strict_types=1);

namespace App\Console\Commands\User;

use App\Actions\Fortify\CreateNewUserAndOrganizationAction;
use App\Data\User\UserData;
use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UserCreateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'user:create
                            {organization : User organization (will be created if not found)}
                            {name : User name}
                            {password : User password}
                            {--email= : User email (default `name`@host if not specified)}
                            {--verified : User email verified or not}
                            {--roles=* : Additional roles beyond the basics}';

    /**
     * @var string
     */
    protected $description = 'Create a user based on input arguments';

    public function handle(Config $config, CreateNewUserAndOrganizationAction $createNewUserAndOrganization): int
    {
        $input = Collection::make($this->arguments())
            ->merge($this->options());

        if (!$input->get('email')) {
            $input->put('email', Str::slug($input->get('name')) . '@' . $config->get('app.host'));
        }

        $input->put('password', $input->get('password'));
        $input->put('password_confirmation', $input->get('password'));
        $input->put('organization', ['name' => $input->pull('organization')]);

        $user = $createNewUserAndOrganization->execute(
            data: UserData::validateAndCreate($input),
        );

        $this->info('User created: ' . (string) $user);

        return 0;
    }
}
