<?php

namespace App\Facade\Clean\Cadastro;

use Illuminate\Support\Facades\Facade;

class SalvarRegistroFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SalvarRegistroClean::class;
    }
}
