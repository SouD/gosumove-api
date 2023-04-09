<?php

declare(strict_types=1);

namespace App\Enums\Auth;

use App\Enums\BackedEnumTrait;

enum RoleNameEnum: string
{
    use BackedEnumTrait;

    case USER = 'user';
    case ROOT = 'root';
}
