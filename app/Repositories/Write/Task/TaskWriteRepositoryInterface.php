<?php

namespace App\Repositories\Write\Task;

use App\Models\Task;

interface TaskWriteRepositoryInterface
{
    public function create(array $data) : Task;

    public function delete(int $id) : void;
    public function findById(int $id) : Task;


}
