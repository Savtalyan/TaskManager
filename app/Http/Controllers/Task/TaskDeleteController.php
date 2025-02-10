<?php

namespace App\Http\Controllers\Task;

use App\Http\Actions\Task\TaskDeleteAction;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class TaskDeleteController extends Controller
{
    public function __invoke(TaskDeleteAction $action, int $id) : JsonResponse
    {
        try {
            $action->handle($id);

            return response()->json([
                'message' => 'Task successfully deleted.'
            ], 201);
        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ], 401);
        }
    }
}
