<?php

namespace Packages\Clean\Application\UseCases\Noticia;

use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Application\Exceptions\RegistroNaoLocalizadoException;
use Packages\Clean\Application\Responses\Dto\Cadastro\RemoverRegistroResponseDTO;
use Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository;
use Packages\Clean\Domain\UseCases\UseCase;

class RemoverNoticiaUseCase implements UseCase
{
    private $repository;
    private $responseDTO;

    public function __construct(NoticiaRepository $repository, RemoverRegistroResponseDTO $responseDTO)
    {
        $this->repository = $repository;
        $this->responseDTO = $responseDTO;
    }

    public function handle($requestDto = null)
    {
        try
        {
            $idNoticia = $requestDto['id'];
            $this->repository->removerNoticia($idNoticia);
            $this->responseDTO->setSucesso(true);
            $this->responseDTO->setMensagem('Notícia removida com sucesso');
        }
        catch(RegistroNaoLocalizadoException $e)
        {
            $this->responseDTO->setMensagem('Não foi possível localizar a notícia solicitada');
        }
        catch(CleanException $e)
        {
            $this->responseDTO->setMensagem('Ocorreu um erro ao tentar remover a notícia');
        }

        return $this->responseDTO;
    }
}
