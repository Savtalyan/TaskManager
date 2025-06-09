<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Status
 *
 * @property int $id
 * @property string $name
 *
 * @mixin \Eloquent
 */
class Status extends Model
{
    protected $table = 'statuses';

    protected $fillable = [
        'name',
    ];

    public function task(): belongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
