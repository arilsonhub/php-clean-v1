<?php

namespace Packages\Clean\Application\UseCases\Noticia;

use Packages\Clean\Application\UseCases\Cadastro\SalvarRegistroUseCase;
use Packages\Clean\Domain\Entities\Noticia;
use Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository;
use Packages\Clean\Domain\UseCases\UseCase;
use Packages\Clean\Domain\Validacao\Noticia\ValidacaoNoticia;

class SalvarNoticiaUseCase implements UseCase
{
    private $repository;
    private $validacao;
    private $useCase;

    public function __construct(SalvarRegistroUseCase $useCase, NoticiaRepository $repository, ValidacaoNoticia $validacao)
    {
        $this->repository = $repository;
        $this->validacao = $validacao;
        $this->useCase = $useCase;
    }

    public function handle($requestDto = null)
    {
        $requestDto->setReferenciaClasseEntidade(Noticia::class);
        $requestDto->setRepository($this->repository);
        $requestDto->setValidacao($this->validacao);
        $requestDto->setDadosDeEntrada($requestDto->getDadosDeEntrada());

        return $this->useCase->handle($requestDto);
    }
}
