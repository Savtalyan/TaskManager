<?php

namespace App\Http\Controllers\Task;

use App\Exceptions\TaskException;
use App\Http\Actions\Task\TaskCreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

class TaskCreateController extends Controller
{
    public function __invoke(TaskCreateRequest $request, TaskCreateAction $action) : JsonResponse
    {
       return $action->handle($request->toDTO());
    }
}
