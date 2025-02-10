<?php

namespace App\Http\Actions\Task;

use App\DTOs\TaskDTO;
use App\Models\Task;
use App\Repositories\Write\Task\TaskWriteRepositoryInterface;

class TaskCreateAction
{
    protected TaskWriteRepositoryInterface $taskWriteRepository;
    public function __construct(TaskWriteRepositoryInterface $taskWriteRepository)
    {
        $this->taskWriteRepository = $taskWriteRepository;
    }
    public function handle(TaskDTO $taskDTO)
    {
        return $this->taskWriteRepository->create($taskDTO->toArray());
    }
}
