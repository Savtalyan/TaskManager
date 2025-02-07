<?php

namespace App\Http\Controllers\User;

use App\Exceptions\UserAlreadyExistsException;
use App\Http\Actions\User\UserRegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;

class UserRegisterController extends Controller
{
    public function __invoke(UserRegisterRequest $request, UserRegisterAction $action)
    {
        try {
            $response = $action->handle($request->toDTO());
            return response()->json([
                'message' => 'User registered successfully.',
                'access_token' => $response['access_token'],
                'refresh_token' => $response['refresh_token'],
                'expires_in' => $response['expires_in']
            ], 201);
        } catch (UserAlreadyExistsException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 409);
        }
    }
}
