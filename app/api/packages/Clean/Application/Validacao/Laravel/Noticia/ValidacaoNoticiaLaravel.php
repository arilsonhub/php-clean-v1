<?php

namespace Packages\Clean\Application\Validacao\Laravel\Noticia;

use Packages\Clean\Application\Validacao\TratamentoValidacaoLaravel;
use Packages\Clean\Domain\Dto\Validacao\ValidacaoDTO;
use Packages\Clean\Domain\Validacao\Noticia\ValidacaoNoticia;

class ValidacaoNoticiaLaravel extends ValidacaoNoticia {

    private $validacaoDTO;
    private $tratamentoValidacao;

    public function __construct(ValidacaoDTO $validacaoDTO, TratamentoValidacaoLaravel $tratamentoValidacao)
    {
        $this->validacaoDTO = $validacaoDTO;
        $this->tratamentoValidacao = $tratamentoValidacao;
    }

    public function validar(Array $dadosDeEntrada) : ValidacaoDTO
    {
        $regras = [
            "id"       => "nullable|numeric",
            "data"     => "required|date_format:Y-m-d",
            "titulo"   => "required"
        ];

        $mensagens = [
            "required"    => "Este campo é obrigatório",
            "numeric"     => "Este campo deve ser numérico",
            "date_format" => "Favor informar uma data válida no formato YYYY-MM-DD"
        ];

        $listaDeErros = $this->tratamentoValidacao->obterListaDeErros($dadosDeEntrada, $regras, $mensagens);
        $ocorreuErros = count($listaDeErros) > 0;

        $this->validacaoDTO->setListaDeErros($listaDeErros);
        $this->validacaoDTO->setOcorreuErros($ocorreuErros);

        return $this->validacaoDTO;
    }
}
