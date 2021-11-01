<?php

namespace App\Factory;

interface GenericFactory {

    public function getInstance($class, $parameters = []);
}
