<?php

namespace App\Http\Actions\User;

use App\Events\UserRegisteredEvent;
use App\Exceptions\UserAlreadyExistsException;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use App\DTOs\UserDTO;

class UserRegisterAction
{
    /**
     * @throws UserAlreadyExistsException
     * @throws ConnectionException
     */

    protected $response;
    protected UserReadRepositoryInterface $userReadRepository;
    protected UserWriteRepositoryInterface $userWriteRepository;
    public function __construct(UserReadRepositoryInterface $userReadRepository, UserWriteRepositoryInterface $userWriteRepository)
    {
        $this->userReadRepository = $userReadRepository;
        $this->userWriteRepository = $userWriteRepository;
    }

    public function handle(UserDto $userDto) : JsonResponse
    {
        try
        {
            $user = $this->userReadRepository->getByEmail($userDto->email);

            if ($user)
            {
                throw new UserAlreadyExistsException();
            }

            $createdUser = $this->userWriteRepository->create($userDto->toArray());

            $response =  Http::asForm()->post(url: config('services.passport.request_token_url'), data: [
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $userDto->email,
                'password' => $userDto->password,
                'scope' => '*'
            ]);
            event(new UserRegisteredEvent($createdUser));
            return $response->json();
        }
        catch (ConnectionException|UserAlreadyExistsException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }
}

