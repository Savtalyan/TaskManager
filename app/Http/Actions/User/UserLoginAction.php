<?php

namespace App\Http\Actions\User;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\DTOs\UserDTO;


class UserLoginAction
{
    /**
     * @throws InvalidCredentialsException
     */
    public function handle(UserDTO $dto)
    {
        $user = User::query()->where('email', $dto->email)->first();
        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw new InvalidCredentialsException();
        }


        return Http::asForm()->post('http://localhost:8001/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $dto->email,
            'password' => $dto->password,
            'scope' => '*'
        ]);
    }
}
