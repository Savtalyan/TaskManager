<?php

namespace App\Http\Controllers\Task;

use App\Http\Actions\Task\TaskStatusChangeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskStatusChangeRequest;
use Illuminate\Http\Request;

class TaskStatusChangeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TaskStatusChangeAction $action, TaskStatusChangeRequest $request, int $id)
    {
        $status = $request->toDTO()->status;
        return $action->handle($id, $status);
    }
}
