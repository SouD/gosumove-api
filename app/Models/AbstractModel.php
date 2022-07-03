<?php
declare(strict_types=1);

namespace App\Models;

use App\Casts\UuidCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class AbstractModel extends Model
{
    /**
     * @var string
     */
    protected $keyType = 'uuid';

    /**
     * @var bool
     */
    public $incrementing = false;

    protected static function booted(): void
    {
        static::saving(static function (AbstractModel $model) {
            if (!$model->getAttribute($model->getKeyName())) {
                $model->setAttribute($model->getKeyName(), Str::orderedUuid());
            }
        });
    }

    /**
     * @return array
     */
    public function getCasts()
    {
        return array_merge([
            $this->getKeyName() => UuidCast::class,
        ], parent::getCasts());
    }
}
