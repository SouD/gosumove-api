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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'pivot',
    ];

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
