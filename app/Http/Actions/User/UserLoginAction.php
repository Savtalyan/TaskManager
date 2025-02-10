<?php

namespace App\Http\Actions\User;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use App\Repositories\Read\User\UserReadRepositoryInterface;
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
    public function handle(UserDTO $dto)
    {
//        dd($dto);
        $user = $this->userReadRepository->getByEmail($dto->email);
//        $user = User::query()->where('email', $dto->email)->first();
        dd($user);
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
