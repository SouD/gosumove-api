<?php
declare(strict_types=1);

namespace App\Data\Organization;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class OrganizationData extends Data
{
    public function __construct(
        #[Required, StringType, Max(161), Unique('organizations', 'name')]
        public string $name,

        public CarbonImmutable|Optional $createdAt,

        public CarbonImmutable|Optional $updatedAt,
    ) {
    }
}
