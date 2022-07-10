<?php
declare(strict_types=1);

namespace App\Models\Auth;

use App\Casts\UuidCast;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken as Model;

class Token extends Model
{
    /**
     * @var string
     */
    protected $table = 'personal_access_tokens';

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'tokenable_type',
        'tokenable_id',
        'token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => UuidCast::class,
        'abilities' => 'json',
        'last_used_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(static function (Token $token) {
            if (!$token->getAttribute($token->getKeyName())) {
                $token->setAttribute($token->getKeyName(), Str::orderedUuid());
            }
        });
    }
}
