<?php

namespace App\Http\Actions\Task;

use App\DTOs\TaskDTO;
use App\Models\Task;
use App\Repositories\Read\Task\TaskReadRepositoryInterface;
use App\Repositories\Write\Task\TaskWriteRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskUpdateAction
{
    protected TaskWriteRepositoryInterface $taskWriteRepository;
    protected TaskReadRepositoryInterface $taskReadRepository;

    public function __construct(TaskWriteRepositoryInterface $taskWriteRepository, TaskReadRepositoryInterface $taskReadRepository)
    {
        $this->taskWriteRepository = $taskWriteRepository;
        $this->taskReadRepository = $taskReadRepository;
    }
    public function handle(TaskDTO $taskDTO, int $id)
    {
        try{
            $task = $this->taskReadRepository->getById($id);

            foreach($this->getUpdatableProperty() as $property) {
                if (!is_null($task->{$property})) {
                    $task->{$property} = $taskDTO->{$property};
                }
            }
            $this->taskWriteRepository->save($task);

            return $task;
        }
        catch(ModelNotFoundException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }


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
