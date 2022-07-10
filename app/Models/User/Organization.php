<?php
declare(strict_types=1);

namespace App\Models\User;

use App\Models\AbstractModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Organization extends Model
{
    use HasApiTokens;
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
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
