<?php

namespace App\Repositories\Write\Task;

use App\Models\Task;
use App\Repositories\Write\Task\TaskWriteRepositoryInterface;

class TaskWriteRepository implements TaskWriteRepositoryInterface
{
    private function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Task::query();
    }

    public function create(array $data): Task
    {
        return $this->query()::create($data);
    }

    public function delete(int $id): void
    {
        $task = Task::find($id);

        if($task)
        {
            $task->delete();
        }
    }

    public function findById(int $id): Task
    {
        return Task::find($id);
    }

    public function save(Task $task): void
    {
        $task->save();
    }
}
