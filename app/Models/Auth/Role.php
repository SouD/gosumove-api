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
