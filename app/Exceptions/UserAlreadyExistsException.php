<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    protected $message = 'User already exists';
    protected $statuscode = 500;

}
