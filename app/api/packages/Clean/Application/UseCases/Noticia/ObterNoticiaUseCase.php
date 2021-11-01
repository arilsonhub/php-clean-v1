<?php

namespace Packages\Clean\Application\UseCases\Noticia;

use Packages\Clean\Application\Exceptions\RegistroNaoLocalizadoException;
use Packages\Clean\Application\Responses\Dto\Cadastro\ConsultaRegistroResponseDTO;
use Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository;
use Packages\Clean\Domain\UseCases\UseCase;

class ObterNoticiaUseCase implements UseCase
{
    private $repository;
    private $responseDTO;

    public function __construct(NoticiaRepository $repository, ConsultaRegistroResponseDTO $responseDTO)
    {
        $this->repository = $repository;
        $this->responseDTO = $responseDTO;
    }

    public function handle($requestDto = null)
    {
        try
        {
            $idNoticia = $requestDto['id'];
            $noticia = $this->repository->obterNoticia($idNoticia);
            $this->responseDTO->setDados($noticia);
        }
        catch(\Exception $e)
        {
            $this->responseDTO->setMensagem("Ocorreu um erro ao tentar obter os dados da notícia.");
        }

        return $this->responseDTO;
    }
}
