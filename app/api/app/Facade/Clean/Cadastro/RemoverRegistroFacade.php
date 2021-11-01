<?php

namespace App\Facade\Clean\Cadastro;

use Illuminate\Support\Facades\Facade;

class RemoverRegistroFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RemoverRegistroClean::class;
    }
}
