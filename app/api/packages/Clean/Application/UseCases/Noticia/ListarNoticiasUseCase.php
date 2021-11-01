<?php

namespace Packages\Clean\Application\UseCases\Noticia;

use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Application\Helper\UseCaseHelper;
use Packages\Clean\Application\Responses\Dto\Cadastro\ListagemResponseDTO;
use Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository;
use Packages\Clean\Domain\UseCases\UseCase;

class ListarNoticiasUseCase implements UseCase
{
    private $repository;
    private $responseDTO;
    private $limiteMaximoDeNoticias = 100;

    public function __construct(NoticiaRepository $repository, ListagemResponseDTO $responseDTO)
    {
        $this->repository = $repository;
        $this->responseDTO = $responseDTO;
    }

    public function handle($requestDto = null)
    {
        try
        {
            $paginacao = $requestDto['paginacao'];
            $limiteDeRegistros = $requestDto['limiteDeRegistros'];
            $semLimitacaoDeDados = (is_null($paginacao) && is_null($limiteDeRegistros));

            if($semLimitacaoDeDados)
                throw new CleanException("É preciso informar parâmetros para limitação e/ou paginação de dados.");

            if(isset($limiteDeRegistros) && $limiteDeRegistros > $this->limiteMaximoDeNoticias)
                throw new CleanException("O limite máximo de registros permitido foi ultrapassado.");

            if(isset($paginacao))
                $this->responseDTO->usarDadosPaginacao(true);

            $repositoryDTO = $this->repository->obterNoticias($paginacao, $limiteDeRegistros);
            $this->responseDTO = UseCaseHelper::copiarDadosRepositoryParaListagem($repositoryDTO, $this->responseDTO);

            return $this->responseDTO;

        }
        catch(CleanException $e)
        {
            $this->responseDTO->setMensagem("Ocorreu uma falha ao tentar obter as notícias.");
        }

        return $this->responseDTO;
    }
}
