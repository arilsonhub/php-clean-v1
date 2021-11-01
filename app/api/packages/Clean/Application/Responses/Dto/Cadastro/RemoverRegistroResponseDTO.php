<?php

namespace Packages\Clean\Application\Responses\Dto\Cadastro;

use JsonSerializable;
use Packages\Clean\Application\Responses\Dto\ResponseDTO;

class RemoverRegistroResponseDTO extends ResponseDTO implements JsonSerializable {

    public function __construct()
    {
        $this->setSucesso(false);
    }

    public function jsonSerialize()
    {
        $dadosJson = [
            'sucesso' => $this->getSucesso(),
            'mensagem' => $this->getMensagem()
        ];

        return $dadosJson;
    }
}
