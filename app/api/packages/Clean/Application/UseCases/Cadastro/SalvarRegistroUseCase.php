<?php

namespace Packages\Clean\Application\UseCases\Cadastro;

use App\Facade\AutoMapperFacade;
use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Application\Requests\Dto\Cadastro\SalvarRegistroRequestDTO;
use Packages\Clean\Application\Responses\Dto\Cadastro\SalvarRegistroResponseDTO;
use Packages\Clean\Domain\Repositories\RepositoryBase;
use Packages\Clean\Domain\UseCases\UseCase;

class SalvarRegistroUseCase implements UseCase
{
    private $responseDTO;

    public function __construct(SalvarRegistroResponseDTO $responseDTO)
    {
        $this->responseDTO = $responseDTO;
    }

    public function handle($requestDTO = null)
    {
        $repository = $requestDTO->getRepository();
        $validacao = $requestDTO->getValidacao();
        $validacaoDTO = null;
        $sucesso = true;
        $listaDeErros = [];
        $mensagem = null;

        try {
            $dadosDeEntrada = $requestDTO->getDadosDeEntrada();
            $validacaoDTO = (!is_null($validacao) ? $validacao->validar($dadosDeEntrada) : null);

            if(!is_null($validacaoDTO))
            {
                $dadosValidados = $validacaoDTO->getDadosValidados();

                if(!is_null($dadosValidados))
                {
                    $dadosDeEntrada = $dadosValidados;
                    $this->responseDTO->setDadosValidados($dadosValidados);
                }

                $sucesso = (!$validacaoDTO->OcorreuErros());
                $listaDeErros = $validacaoDTO->getListaDeErros();
                $mensagem = ($sucesso === false ? "Ocorreram erros na validação do cadastro" : "");
            }

            if($sucesso)
            {
                $this->salvar($dadosDeEntrada, $requestDTO, $repository);
                $mensagem = "Dados salvos com sucesso.";
            }
        } catch(CleanException $e){
            $sucesso = false;
            $mensagem = "Ocorreu uma falha ao tentar salvar os dados.";
        }

        $this->responseDTO->setSucesso($sucesso);
        $this->responseDTO->setMensagem($mensagem);
        $this->responseDTO->setListaDeErros($listaDeErros);

        return $this->responseDTO;
    }

    private function salvar(Array $dadosDeEntrada, SalvarRegistroRequestDTO $requestDTO, RepositoryBase $repository)
    {
        $objetoEntidade = AutoMapperFacade::autoMap($dadosDeEntrada, $requestDTO->getReferenciaClasseEntidade());
        $repository->atualizar($objetoEntidade);
        $this->responseDTO->setId($objetoEntidade->obterValorDaChavePrimariaDaEntidade());
    }
}
