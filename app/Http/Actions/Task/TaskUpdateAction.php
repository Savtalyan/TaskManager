<?php

namespace App\Http\Actions\Task;

use App\DTOs\TaskDTO;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskUpdateAction
{
    public function handle(TaskDTO $taskDTO, int $id)
    {
        $task = Task::findOrFail($id);

        foreach($this->getUpdatableProperty() as $property) {
            if (!is_null($task->{$property})) {
                $task->{$property} = $taskDTO->{$property};
            }
        }
        $task->save();

        return $task;
    }

    public function getUpdatableProperty() : array
    {
        return [
            'assignee',
            'assigner',
            'subject',
            'description',
            'status',
            'priority',
            'due_date',
        ];
    }
}
