<?php

namespace Packages\Clean\Application\Exceptions;

use App\Facade\Clean\CleanLogFacade;
use Packages\Clean\Application\Helper\ExceptionHelper;

class CleanException extends \Exception {

    private $data;

    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        CleanLogFacade::error("[CleanExceptionLog]: {$message}");
        ExceptionHelper::reportar($this);
        parent::__construct($message, $code, $previous);
    }

    public function getData()
    {
        return $this->data;
    }

    protected function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
