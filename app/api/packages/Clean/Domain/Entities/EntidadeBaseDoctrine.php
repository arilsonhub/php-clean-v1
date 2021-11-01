<?php

namespace Packages\Clean\Domain\Entities;

abstract class EntidadeBaseDoctrine implements EntidadeBase {

    private $nomeChavePrimaria;

    public function __construct($nomeChavePrimaria)
    {
        $this->nomeChavePrimaria = $nomeChavePrimaria;
    }

    public function obterNomeDaChavePrimaria()
    {
        return $this->nomeChavePrimaria;
    }

    public function obterNomeDoObjetoDaEntidade()
    {
        //Sem implementação
    }

    public function obterNomeDaConexao()
    {
        //Sem implementação
    }

    public function setKeysForSaveQuery($query)
    {
        //Sem implementação
    }

    public function getKeyForSaveQuery($keyName = null)
    {
        //Sem implementação
    }

    public function toArray()
    {
        //Sem implementação
    }
}
