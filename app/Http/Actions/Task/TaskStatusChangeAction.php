<?php

namespace App\Http\Actions\Task;

use App\Models\Task;
use App\Repositories\Write\Task\TaskWriteRepository;
use App\Repositories\Write\Task\TaskWriteRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class TaskStatusChangeAction
{
    protected TaskWriteRepositoryInterface $taskWriteRepository;

    public function __construct(TaskWriteRepositoryInterface $taskWriteRepository)
    {
        $this->taskWriteRepository = $taskWriteRepository;
    }

    public function handle(int $id, string $status)
    {
        $task = $this->taskWriteRepository->findById($id);
        $userID = auth()->id();

        if ($userID !== $task->assignee) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $task->status = $status;
        $task->save();
    }
}
