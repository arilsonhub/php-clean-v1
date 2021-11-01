<?php

namespace App\Facade\Clean;

use Illuminate\Support\Facades\Facade;

class CleanLogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CleanLog::class;
    }
}
