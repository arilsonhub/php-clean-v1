<?php

namespace Packages\Clean\Domain\Repositories;

abstract class RepositoryBase {

    abstract public function adicionar($objeto);

    abstract public function obterPeloId($id, $objeto = null);

    abstract public function obterTodos($objeto = null);

    abstract public function atualizar($objeto);

    abstract public function remover($objeto);

    abstract public function createQueryBuilder($alias, $indexBy = null);
}
