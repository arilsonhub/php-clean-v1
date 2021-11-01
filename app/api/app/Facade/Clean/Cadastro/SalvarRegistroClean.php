<?php

namespace App\Facade\Clean\Cadastro;

use App\Factory\GenericFactory;
use App\Presenters\Http\JsonPresenter;
use Packages\Clean\Application\Requests\Dto\Cadastro\SalvarRegistroRequestDTO;
use Packages\Clean\Domain\UseCases\UseCase;

class SalvarRegistroClean
{
    public function execute(Array $dadosDeEntrada, UseCase $useCase, JsonPresenter $presenter, GenericFactory $genericFactory)
    {
        $requestDTO = $genericFactory->getInstance(SalvarRegistroRequestDTO::class);
        $requestDTO->setDadosDeEntrada($dadosDeEntrada);
        $responseDTO = $useCase->handle($requestDTO);
        $response = $presenter->sendViewModelFromArray(["retorno" => $responseDTO]);
        $desfazerTransacao = $responseDTO->getDesfazerTransacao();

        if($desfazerTransacao)
            $response->header("undo-transaction", "true");

        return $response;
    }
}
