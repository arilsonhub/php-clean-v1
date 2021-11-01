<?php

namespace Packages\Clean\Domain\ValueObjects;

class Paginacao {

    private $paginaAtual;
    private $registrosPorPagina;
    private $opcoesDeRegistrosPorPagina;

    public function __construct($paginaAtual, $registrosPorPagina)
    {
        $this->setPaginaAtual($paginaAtual);
        $this->setRegistrosPorPagina($registrosPorPagina);
        $this->opcoesDeRegistrosPorPagina = [10, 20, 25, 50, 100];
    }

    public function getPaginaAtual(){
		return $this->paginaAtual;
	}

	private function setPaginaAtual($paginaAtual){

        if(!isset($paginaAtual))
            $paginaAtual = 1;

        if(!is_numeric($paginaAtual))
            $paginaAtual = 1;

        if($paginaAtual < 1)
            $paginaAtual = 1;

		$this->paginaAtual = $paginaAtual;
	}

	public function getRegistrosPorPagina(){

        $registrosPorPagina = $this->registrosPorPagina;
        $naoEhValido = (!isset($registrosPorPagina) || !is_numeric($registrosPorPagina));
        $menorQueZero = ($registrosPorPagina <= 0);
        $naoEstaEntreAsOpcoesPermitidas = (!in_array($registrosPorPagina, $this->opcoesDeRegistrosPorPagina));

        if($naoEhValido || $menorQueZero || $naoEstaEntreAsOpcoesPermitidas)
            return env('DEFAULT_PAGINATION_LIMIT', 50);

		return $this->registrosPorPagina;
	}

	private function setRegistrosPorPagina($registrosPorPagina){
		$this->registrosPorPagina = $registrosPorPagina;
	}
}
