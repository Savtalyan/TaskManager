<?php

namespace App\Http\Actions\User;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\DTOs\UserDTO;


class UserLoginAction
{
    protected UserReadRepositoryInterface $userReadRepository;

    public function __construct(UserReadRepositoryInterface $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
    }
    /**
     * @throws InvalidCredentialsException
     */
    public function handle(UserDTO $userDto)
    {
        try {
            $user = $this->userReadRepository->getByEmail($userDto->email);

            if (!$user || !Hash::check($userDto->password, $user->password))
            {
                throw new InvalidCredentialsException();
            }

            $response =  Http::asForm()->post(url: config('services.passport.request_token_url'), data: [
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $userDto->email,
                'password' => $userDto->password,
                'scope' => '*'
            ]);

            return $response->json();

        }
        catch (InvalidCredentialsException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }
}
