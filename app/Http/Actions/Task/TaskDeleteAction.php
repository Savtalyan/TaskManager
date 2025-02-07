<?php

namespace App\Http\Actions\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskDeleteAction
{
    public function handle(int $id)
    {
        $task = Task::query()->findOrFail($id);

        $task->delete();
    }
}
