<?php
declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

trait BackedEnumTrait
{
    public static function all(): array
    {
        return Collection::make(static::cases())
            ->map(fn ($enum) => ['name' => $enum->name, 'value' => $enum->value])
            ->all();
    }
}
