<?php

namespace App\Facade;

class AutoMapperClean
{
    public function autoMap($source, $targetClass, Array $context = [])
    {
        return auto_map($source, $targetClass, $context);
    }
}
