<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int|null $assignee_id
 * @property int|null $assigner_id
 * @property int $creator_id
 * @property int $status_id
 * @property int $priority_id
 * @property string $subject
 * @property string|null $description
 * @property Carbon|null $due_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|User whereId($value)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 *
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'creator_id',
        'assigner_id',
        'assignee_id',
        'status_id',
        'priority_id',
        'subject',
        'description',
        'due_date'
    ];

    protected $with = ['status', 'priority', 'assignee', 'assigner'];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigner_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

}
