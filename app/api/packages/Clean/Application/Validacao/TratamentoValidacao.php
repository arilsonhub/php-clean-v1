<?php

namespace Packages\Clean\Application\Validacao;

use Packages\Clean\Domain\Dto\Validacao\RegraCampoValorUnicoDTO;
use Packages\Clean\Domain\Dto\Validacao\RegraNomeUnicoParaGrupoDTO;
use Packages\Clean\Domain\Repositories\RepositoryBase;

interface TratamentoValidacao {

    public function obterListaDeErros(Array $dadosDeEntrada, Array $regras, Array $mensagens) : Array;
}
