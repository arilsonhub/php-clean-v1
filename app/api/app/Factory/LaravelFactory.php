<?php

namespace App\Factory;

class LaravelFactory implements GenericFactory {

    public function getInstance($class, $parameters = [])
    {
        return app($class, $parameters);
    }
}
