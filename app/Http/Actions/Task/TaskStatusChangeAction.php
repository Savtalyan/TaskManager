<?php

namespace App\Http\Actions\Task;

use App\Models\Task;

class TaskStatusChangeAction
{
    public function handle(int $id, string $status)
    {
        $task = Task::query()->where('id', $id)->first();
        $task->status = $status;
        $task->save();
    }
}
