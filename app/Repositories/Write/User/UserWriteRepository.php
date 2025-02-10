<?php

namespace App\Repositories\Write\User;

use App\Models\User;

class UserWriteRepository implements UserWriteRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $data) : User
    {
        return $this::create($data);
    }

    public function update(User $user, array $data) : User
    {
        return $this::update($user, $data);
    }
}
