<?php

namespace Packages\Clean\Application\Responses\Dto;

abstract class ResponseDTO {

    private $sucesso;
    private $mensagem;
    private $id;
    private $desfazerTransacao = false;

    public function getSucesso(){
		return $this->sucesso;
	}

	public function setSucesso($sucesso){
		$this->sucesso = $sucesso;
	}

	public function getMensagem(){
		return $this->mensagem;
	}

	public function setMensagem($mensagem){
		$this->mensagem = $mensagem;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
    }

    public function setDesfazerTransacao($desfazerTransacao){
        $this->desfazerTransacao = $desfazerTransacao;
    }

    public function getDesfazerTransacao(){
        return $this->desfazerTransacao;
    }
}
