<?php

declare(strict_types=1);

namespace App\Data\User;

use App\Data\Organization\OrganizationData;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(SnakeCaseMapper::class), MapOutputName(SnakeCaseMapper::class)]
class UserData extends Data
{
    public function __construct(
        #[Required, StringType, Max(161)]
        public string $name,

        #[Required, StringType, Email('rfc'), Max(161), Unique('users', 'email')]
        public string $email,

        public CarbonImmutable|Optional $emailVerifiedAt,

        #[Sometimes, StringType, Confirmed, Max(161)]
        public string|Optional $password,

        public string|Optional $passwordConfirmation,

        public string|Optional $rememberToken,

        public CarbonImmutable|Optional $createdAt,

        public CarbonImmutable|Optional $updatedAt,

        public int|Optional $logins,

        public OrganizationData|Optional|Lazy $organization,
    ) {
    }
}
