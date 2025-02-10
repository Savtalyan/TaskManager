<?php

namespace App\Repositories\Read\User;

use App\Models\User;
use App\Repositories\Read\User\UserReadRepositoryInterface;

class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query();
    }

    public function getById(int $id) : ?User
    {
        return $this->query()->find($id);
    }

    public function getByEmail(string $email) : ?User
    {
        return $this->query()->where('email', $email)->first();
    }
}
