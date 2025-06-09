<?php

namespace App\Http\Controllers\User;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Actions\User\UserLoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use Illuminate\Http\JsonResponse;

class UserLoginController extends Controller
{

    /**
     * @throws InvalidCredentialsException
     */
    public function __invoke(UserLoginAction $action, UserLoginRequest $request)
    {
        return $action->handle($request->toDTO());
    }
}
