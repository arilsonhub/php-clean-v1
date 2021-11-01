<?php

namespace Packages\Clean\Domain\Dto\Validacao;

class ValidacaoDTO {

    private $listaDeErros;
    private $ocorreuErros;
    private $dadosValidados;

    public function getListaDeErros(){
		return $this->listaDeErros;
	}

	public function setListaDeErros($listaDeErros){
		$this->listaDeErros = $listaDeErros;
	}

	public function OcorreuErros(){
		return $this->ocorreuErros;
	}

	public function setOcorreuErros($ocorreuErros){
		$this->ocorreuErros = $ocorreuErros;
    }

    public function getDadosValidados()
    {
        return $this->dadosValidados;
    }

    public function setDadosValidados($dadosValidados)
    {
        $this->dadosValidados = $dadosValidados;

        return $this;
    }
}
