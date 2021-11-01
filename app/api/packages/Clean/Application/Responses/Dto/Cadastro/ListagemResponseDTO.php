<?php

namespace Packages\Clean\Application\Responses\Dto\Cadastro;

use JsonSerializable;

class ListagemResponseDTO implements JsonSerializable {

    private $dados;
    private $ultimaPagina;
    private $totalRegistros;
    private $registrosPorPagina;
    private $paginaAtual;
    private $listaDeErros;
    private $serializarDadosPaginacao;
    private $mensagem;

    public function __construct()
    {
        $this->serializarDadosPaginacao = false;
        $this->paginaAtual = 1;
        $this->dados = [];
        $this->ultimaPagina = 1;
        $this->totalRegistros = 0;
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

    public function getListaDeErros() : Array
    {
        return $this->listaDeErros;
    }

    public function setListaDeErros(Array $listaDeErros)
    {
        $this->listaDeErros = $listaDeErros;

        return $this;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    public function usarDadosPaginacao(bool $usarDadosPaginacao)
    {
        $this->serializarDadosPaginacao = $usarDadosPaginacao;
    }

    public function jsonSerialize()
    {
        $dadosJson = [
            'dados' => $this->dados
        ];

        if($this->serializarDadosPaginacao)
        {
            $dadosJson['paginacao'] = [
                       'paginaAtual'        => $this->paginaAtual,
                       'registrosPorPagina' => $this->registrosPorPagina,
                       'ultimaPagina'       => $this->ultimaPagina,
                       'totalRegistros'     => $this->totalRegistros
            ];
        }

        if(!is_null($this->mensagem))
            $dadosJson['mensagem'] = $this->mensagem;

        if(!is_null($this->listaDeErros))
            $dadosJson['listaDeErros'] = $this->listaDeErros;

        return $dadosJson;
    }
}
