<?php
declare(strict_types=1);

namespace Database\Factories\Auth;

use App\Enums\Auth\PermissionNameEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auth\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()
                ->name(),
        ];
    }

    public function all(): Factory
    {
        $cases = Collection::make(PermissionNameEnum::all())
            ->pluck('value')
            ->map(fn ($value, $key) => ['name' => $value]);

        return $this->count($cases->count())
            ->state(new Sequence(...$cases->all()));
    }
}
