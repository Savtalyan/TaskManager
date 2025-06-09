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
        return $action->handle($id);
    }
}
