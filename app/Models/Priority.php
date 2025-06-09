<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Priority
 *
 * @property int $id
 * @property string $name
 *
 * @mixin \Eloquent
 */
class Priority extends Model
{
    protected $table = 'priority';

    protected $fillable = [
        'name',
    ];

    public function task(): belongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
