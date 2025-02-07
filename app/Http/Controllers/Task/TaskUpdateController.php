<?php

namespace App\Http\Controllers\Task;

use App\Http\Actions\Task\TaskUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Exceptions\TaskUpdateException;

class TaskUpdateController extends Controller
{
    public function __invoke(TaskUpdateRequest $request, TaskUpdateAction $action, int $id): JsonResponse
    {
        try {
            $task = $action->handle($request->toDto(), $id);
            return response()->json([
                'message' => 'Task successfully updated.',
            ]);
        }
        catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
        catch (TaskUpdateException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }
}
