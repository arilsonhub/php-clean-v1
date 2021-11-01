<?php

namespace Packages\Clean\Application\Responses\Dto\Cadastro;

use JsonSerializable;
use Packages\Clean\Application\Responses\Dto\ResponseDTO;

class ConsultaRegistroResponseDTO extends ResponseDTO implements JsonSerializable {

    private $dados;

    public function getDados()
    {
        return $this->dados;
    }

    public function setDados($dados)
    {
        $this->dados = $dados;
    }

    public function jsonSerialize()
    {
        $mensagem = $this->getMensagem();
        $sucesso = $this->getSucesso();
        $dadosJson = [
            'dados' => $this->dados
        ];

        if(!is_null($sucesso))
            $dadosJson['sucesso'] = $sucesso;

        if(!is_null($mensagem))
            $dadosJson['mensagem'] = $mensagem;

        return $dadosJson;
    }
}
