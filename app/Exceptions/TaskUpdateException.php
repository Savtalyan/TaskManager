<?php

namespace App\Exceptions;

use Exception;

class TaskUpdateException extends Exception
{
    protected $message = 'Task update failed';
    protected $code = 500;

    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
