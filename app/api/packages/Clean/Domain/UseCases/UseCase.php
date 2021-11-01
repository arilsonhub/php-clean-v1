<?php

namespace Packages\Clean\Domain\UseCases;

interface UseCase {

    public function handle($requestDto = null);
}
