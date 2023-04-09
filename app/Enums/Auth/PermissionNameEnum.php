<?php

declare(strict_types=1);

namespace App\Enums\Auth;

use App\Enums\BackedEnumTrait;

enum PermissionNameEnum: string
{
    use BackedEnumTrait;

    case AUTH_LOGIN = 'auth.login';

    case AUTH_TOKEN_CREATE = 'auth.token.create';
    case AUTH_TOKEN_DELETE = 'auth.token.delete';
}
