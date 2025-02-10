<?php

namespace App\Http\Actions\Task;

use App\DTOs\TaskDTO;
use App\Models\Task;
use App\Repositories\Write\Task\TaskWriteRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskUpdateAction
{
    protected TaskWriteRepositoryInterface $taskWriteRepository;

    public function __construct(TaskWriteRepositoryInterface $taskWriteRepository)
    {
        $this->taskWriteRepository = $taskWriteRepository;
    }
    public function handle(TaskDTO $taskDTO, int $id)
    {
        $task = $this->taskWriteRepository->findById($id);

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
