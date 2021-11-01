<?php

namespace Packages\Clean\Application\Responses\Dto;

class RepositoryDTO {

    private $dados;
    private $ultimaPagina;
    private $totalRegistros;
    private $registrosPorPagina;
    private $paginaAtual;

    public function __construct()
    {
        $this->dados = [];
        $this->ultimaPagina = 1;
        $this->totalRegistros = 0;
        $this->paginaAtual = 1;
    }

    public function getDados(){
		return $this->dados;
	}

	public function setDados($dados){
		$this->dados = $dados;
	}

	public function getUltimaPagina(){
		return $this->ultimaPagina;
	}

	public function setUltimaPagina($ultimaPagina){
		$this->ultimaPagina = $ultimaPagina;
	}

	public function getTotalRegistros(){
		return $this->totalRegistros;
	}

	public function setTotalRegistros($totalRegistros){
		$this->totalRegistros = $totalRegistros;
    }

    public function setPaginaAtual($paginaAtual){
        $this->paginaAtual = $paginaAtual;
    }

    public function getPaginaAtual(){
        return $this->paginaAtual;
    }

    public function setRegistrosPorPagina($registrosPorPagina){
        $this->registrosPorPagina = $registrosPorPagina;
    }

    public function getRegistrosPorPagina(){
        return $this->registrosPorPagina;
    }
}
