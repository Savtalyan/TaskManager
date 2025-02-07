<?php

namespace App\Http\Actions\Task;

use App\DTOs\TaskDTO;
use App\Models\Task;

class TaskCreateAction
{
    public function handle(TaskDTO $taskDTO)
    {

        return Task::create([
            'assignee' => $taskDTO->assignee,
            'assigner' => $taskDTO->assigner,
            'subject' => $taskDTO->subject,
            'description' => $taskDTO->description,
            'priority' => $taskDTO->priority,
            'due_date' => $taskDTO->due_date
        ]);
    }
}
