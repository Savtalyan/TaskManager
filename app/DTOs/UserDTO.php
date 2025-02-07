<?php

namespace App\DTOs;
class UserDTO
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;

    public function __construct(string $email, string $password, string $name = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}
