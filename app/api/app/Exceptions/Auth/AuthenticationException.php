<?php

namespace App\Exceptions\Auth;

use Packages\Clean\Application\Exceptions\CleanException;

class AuthenticationException extends CleanException {

    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

