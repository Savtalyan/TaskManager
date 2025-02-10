<?php

namespace App\Http\Actions\User;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\Repositories\Write\User\UserWriteRepository;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
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

    protected UserWriteRepositoryInterface $userWriteRepository;
    public function __construct(UserWriteRepositoryInterface $userWriteRepository)
    {
        $this->userWriteRepository = $userWriteRepository;
    }

    public function handle(UserDTO $dto)
    {
        $user = User::query()->where('email', $dto->email)->first();

        if ($user) {
            throw new UserAlreadyExistsException('User already exists.');
        }

        $this->userWriteRepository->create($dto->toArray());

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
