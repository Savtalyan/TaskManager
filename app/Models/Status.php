<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\StatusFactory
 *
 * @property int $id
 * @property string $name
 *
 * @mixin \Eloquent
 */
class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
