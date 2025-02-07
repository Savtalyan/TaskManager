<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignee_id',
        'assigner_id',
        'status',
        'priority',
        'subject',
        'description',
        'due_date'
    ];
}
