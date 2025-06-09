<?php

namespace App\Repositories\Read\Task;

use App\Models\Task;

interface TaskReadRepositoryInterface
{
    public function getById(int $id) : ?Task;
}
