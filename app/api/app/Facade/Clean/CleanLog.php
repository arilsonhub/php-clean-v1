<?php

namespace App\Facade\Clean;

use Illuminate\Support\Facades\Log;

class CleanLog
{
    public function error($mensagem, $contexto = [])
    {
        Log::error($mensagem, $contexto);
    }
}
