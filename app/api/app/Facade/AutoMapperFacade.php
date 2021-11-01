<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class AutoMapperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AutoMapperClean::class;
    }
}
