<?php

namespace Packages\Clean\Domain\Validacao;

use Packages\Clean\Domain\Dto\Validacao\ValidacaoDTO;

abstract class ValidacaoPadrao {

    abstract public function validar(Array $dadosDeEntrada) : ValidacaoDTO;
}
