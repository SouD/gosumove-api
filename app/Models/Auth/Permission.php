<?php
declare(strict_types=1);

namespace App\Models\Auth;

use App\Enums\Auth\PermissionNameEnum;
use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $casts = [
        'name' => PermissionNameEnum::class,
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
