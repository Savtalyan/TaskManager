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
            return response()->json([
                'message' => 'You cannot perform this action.',
                'code' => Response::HTTP_FORBIDDEN
            ]);
        }

        $task->status = $status;
        $this->taskWriteRepository->save($task);

        return response()->json([
            'message' => 'Task status has been changed.',
            'code' => Response::HTTP_OK
        ]);
    }
}
