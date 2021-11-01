<?php

namespace Packages\Clean\Domain\Entities;

interface EntidadeBase {

    public function obterNomeDoObjetoDaEntidade();

    public function obterNomeDaChavePrimaria();

    public function obterValorDaChavePrimariaDaEntidade();

    public function obterNomeDaConexao();

    public function setKeysForSaveQuery($query);

    public function getKeyForSaveQuery($keyName = null);

    public function toArray();
}
