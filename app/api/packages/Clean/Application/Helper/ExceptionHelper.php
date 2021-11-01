<?php

namespace Packages\Clean\Application\Helper;

class ExceptionHelper {

    public static function reportar(\Exception $e)
    {
        report($e);
    }
}
