<?php

namespace Packages\Clean\Domain\Repositories\Noticia;

use Packages\Clean\Application\Dao\DoctrineDaoBase;
use Packages\Clean\Application\Responses\Dto\RepositoryDTO;
use Packages\Clean\Domain\ValueObjects\Paginacao;

abstract class NoticiaRepository extends DoctrineDaoBase {

    abstract public function obterNoticias(Paginacao $paginacao, $limiteDeRegistros) : RepositoryDTO;

    abstract public function obterNoticia($id) : Array;

    abstract public function removerNoticia($id);
}
