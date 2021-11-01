<?php

namespace App\Facade\Clean\Cadastro;

use App\Presenters\Http\JsonPresenter;
use Packages\Clean\Domain\UseCases\UseCase;

class RemoverRegistroClean
{
    public function execute($requestDTO, UseCase $useCase, JsonPresenter $presenter)
    {
        $responseDTO = $useCase->handle($requestDTO);
        $response = $presenter->sendViewModelFromArray(["retorno" => $responseDTO]);
        $desfazerTransacao = $responseDTO->getDesfazerTransacao();

        if($desfazerTransacao)
            $response->header("undo-transaction", "true");

        return $response;
    }
}
