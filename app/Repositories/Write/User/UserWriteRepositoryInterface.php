<?php

namespace App\Repositories\Write\User;

use App\Models\User;

interface UserWriteRepositoryInterface
{
    public function create(array $data) : User;
    public function update(User $user, array $data) : User;
}
