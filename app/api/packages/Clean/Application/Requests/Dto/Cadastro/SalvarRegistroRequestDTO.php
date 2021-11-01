<?php

namespace Packages\Clean\Application\Requests\Dto\Cadastro;

use Packages\Clean\Domain\Repositories\RepositoryBase;
use Packages\Clean\Domain\Validacao\ValidacaoPadrao;

class SalvarRegistroRequestDTO {

    private $dadosDeEntrada;
    private $referenciaClasseEntidade;
    private $repository;
    private $validacao;

    /**
     * Get the value of referenciaClasseEntidade
     */
    public function getReferenciaClasseEntidade()
    {
        return $this->referenciaClasseEntidade;
    }

    /**
     * Set the value of referenciaClasseEntidade
     *
     * @return  self
     */
    public function setReferenciaClasseEntidade($referenciaClasseEntidade)
    {
        $this->referenciaClasseEntidade = $referenciaClasseEntidade;

        return $this;
    }

    /**
     * Get the value of repository
     */
    public function getRepository() : RepositoryBase
    {
        return $this->repository;
    }

    /**
     * Set the value of repository
     *
     * @return  self
     */
    public function setRepository(RepositoryBase $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Get the value of validacao
     */
    public function getValidacao() : ?ValidacaoPadrao
    {
        return $this->validacao;
    }

    /**
     * Set the value of validacao
     *
     * @return  self
     */
    public function setValidacao(?ValidacaoPadrao $validacao)
    {
        $this->validacao = $validacao;

        return $this;
    }

    /**
     * Get the value of dadosDeEntrada
     */
    public function getDadosDeEntrada() : Array
    {
        return $this->dadosDeEntrada;
    }

    /**
     * Set the value of dadosDeEntrada
     *
     * @return  self
     */
    public function setDadosDeEntrada(Array $dadosDeEntrada)
    {
        $this->dadosDeEntrada = $dadosDeEntrada;

        return $this;
    }
}
