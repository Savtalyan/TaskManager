<?php

namespace App\Http\Actions\Task;

use App\Models\Task;
use App\Repositories\Write\Task\TaskWriteRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskDeleteAction
{
    protected TaskWriteRepositoryInterface $taskWriteRepository;

    public function __construct(TaskWriteRepositoryInterface $taskWriteRepository)
    {
        $this->taskWriteRepository = $taskWriteRepository;
    }

    public function handle(int $id)
    {
        $this->taskWriteRepository->delete($id);

        return response()->json([
            'message' => 'Task deleted'
        ]);
    }
}
