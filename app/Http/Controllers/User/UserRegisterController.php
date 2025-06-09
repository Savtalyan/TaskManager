<?php

namespace App\Http\Controllers\User;

use App\Events\UserRegisteredEvent;
use App\Exceptions\UserAlreadyExistsException;
use App\Http\Actions\User\UserRegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;

class UserRegisterController extends Controller
{
    public function __invoke(UserRegisterRequest $request, UserRegisterAction $action) : \Illuminate\Http\JsonResponse
    {
        return $action->handle($request->toDTO());
    }
}
