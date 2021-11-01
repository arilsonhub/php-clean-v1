<?php

namespace Packages\Clean\Application\Responses\Dto\Cadastro;

use JsonSerializable;
use Packages\Clean\Application\Responses\Dto\ResponseDTO;

class SalvarRegistroResponseDTO extends ResponseDTO implements JsonSerializable {

    private $listaDeErros;
    private $dadosValidados;

    public function getListaDeErros(){
		return $this->listaDeErros;
	}

	public function setListaDeErros($listaDeErros){
		$this->listaDeErros = $listaDeErros;
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

    public function jsonSerialize()
    {
        $dadosJson = [
            'sucesso' => $this->getSucesso(),
            'mensagem' => $this->getMensagem()
        ];

        if(!is_null($this->listaDeErros))
            $dadosJson['listaDeErros'] = $this->listaDeErros;

        return $dadosJson;
    }
}
