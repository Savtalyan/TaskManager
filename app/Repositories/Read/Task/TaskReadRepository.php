<?php

namespace App\Repositories\Read\Task;

use App\Models\Task;
use App\Repositories\Read\Task\TaskReadRepositoryInterface;

class TaskReadRepository implements TaskReadRepositoryInterface
{
    public function getById(int $id) : ?Task{
        return Task::find($id);
    }
}
