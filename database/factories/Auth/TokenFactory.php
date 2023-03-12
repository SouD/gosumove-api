<?php
declare(strict_types=1);

namespace Database\Factories\Auth;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auth\Token>
 */
class TokenFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tokenable_type' => 'user',
            'tokenable_id' => User::factory(),
            'name' => $this->faker->word(),
            'token' => \hash('sha256', Str::random(40)),
            'abilities' => '*',
            'expires_at' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
        ];
    }
}
