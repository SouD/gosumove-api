<?php

declare(strict_types=1);

namespace App\Models\Auth;

use App\Enums\Auth\RoleNameEnum;
use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
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
        'name' => RoleNameEnum::class,
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
