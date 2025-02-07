<?php

namespace App\Http\Actions\User;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\DTOs\UserDTO;

class UserRegisterAction
{
    /**
     * @throws UserAlreadyExistsException
     * @throws ConnectionException
     */
    public function handle(UserDTO $dto)
    {
        $user = User::query()->where('email', $dto->email)->first();

        if ($user) {
            throw new UserAlreadyExistsException('User already exists.');
        }

        User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);

        $response = Http::post(url: 'http://localhost:8001/oauth/token', data: [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $dto->email,
            'password' => $dto->password
        ]);
        return $response->json();
    }
}
