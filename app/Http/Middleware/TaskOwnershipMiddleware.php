<?php

namespace App\Http\Middleware;

use App\Http\Requests\Task\TaskStatusChangeRequest;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskOwnershipMiddleware
{

    public function handle(TaskStatusChangeRequest $request, Closure $next): Response
    {
        $userID = auth()->id();
        $task = Task::query()->where('id', $request->toDTO()->status)->first();
        $task_id = $task->assignee;

        if ($userID !== $task_id) {
            abort(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
