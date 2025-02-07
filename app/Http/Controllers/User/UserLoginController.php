<?php

namespace App\Http\Controllers\User;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Actions\User\UserLoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use Illuminate\Http\JsonResponse;

class UserLoginController extends Controller
{
    public function __invoke(UserLoginRequest $request, UserLoginAction $action) : JsonResponse|array
    {

        try {
            $response = $action->handle($request->toDTO());
            return response()->json([
                'message' => 'Login successful',
                'access_token' => $response['access_token'],
                'refresh_token' => $response['refresh_token'],
                'expires_in' => $response['expires_in'],
            ], 201);
        }
        catch (InvalidCredentialsException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 401);
        }

    }
}
