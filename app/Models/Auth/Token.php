<?php
declare(strict_types=1);

namespace App\Models\Auth;

use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken as Model;

class Token extends Model
{
    /**
     * @var string
     */
    protected $table = 'personal_access_tokens';

    protected static function booted(): void
    {
        static::saving(static function (Token $token) {
            if (!$token->getAttribute($token->getKeyName())) {
                $token->setAttribute($token->getKeyName(), Str::orderedUuid());
            }
        });
    }
}
