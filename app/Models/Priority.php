<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\PriorityFactory
 *
 * @property int $id
 * @property string $name
 *
 * @mixin \Eloquent
 */
class Priority extends Model
{
    use HasFactory;

    protected $table = 'priorities';

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
