<?php

namespace App\Http\Controllers\Api;

use App\Facade\Clean\Cadastro\RemoverRegistroFacade;
use App\Facade\Clean\Cadastro\SalvarRegistroFacade;
use App\Factory\GenericFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Presenters\Http\JsonPresenter;
use Packages\Clean\Application\UseCases\Noticia\ListarNoticiasUseCase;
use Packages\Clean\Application\UseCases\Noticia\ObterNoticiaUseCase;
use Packages\Clean\Application\UseCases\Noticia\RemoverNoticiaUseCase;
use Packages\Clean\Application\UseCases\Noticia\SalvarNoticiaUseCase;
use Packages\Clean\Domain\ValueObjects\Paginacao;

class NoticiaController extends Controller
{
    private $genericFactory;

    public function __construct(GenericFactory $genericFactory)
    {
        $this->genericFactory = $genericFactory;
    }

    public function listar(Request $request, ListarNoticiasUseCase $useCase, JsonPresenter $presenter)
    {
        $paginacao = null;
        $paginaAtual = $request->input('page');

        if(isset($paginaAtual)) {
            $paginacao = $this->genericFactory->getInstance(Paginacao::class,
            [
                'paginaAtual' => $request->input('page'),
                'registrosPorPagina' => $request->input('registrosPorPagina')
            ]);
        }

        $requestArray = [];
        $requestArray['limiteDeRegistros'] = $request->input('limiteDeRegistros');
        $requestArray['paginacao'] = $paginacao;

        $responseDTO = $useCase->handle($requestArray);
        return $presenter->sendViewModelFromArray(['retorno' => $responseDTO]);
    }

    public function obterNoticia($id, ObterNoticiaUseCase $useCase, JsonPresenter $presenter)
    {
        $requestArray = ['id' => $id];
        $httpCodigoStatus = 200;
        $responseDTO = $useCase->handle($requestArray);

        if(is_null($responseDTO->getDados()))
            $httpCodigoStatus = 404;

        return $presenter->sendViewModelFromArray(["retorno" => $responseDTO], $httpCodigoStatus);
    }

    public function salvar(Request $request, SalvarNoticiaUseCase $useCase, JsonPresenter $presenter)
    {
        $requestArray = $request->only(['id', 'data', 'titulo']);

        return SalvarRegistroFacade::execute($requestArray, $useCase, $presenter, $this->genericFactory);
    }

    public function remover($id, RemoverNoticiaUseCase $useCase, JsonPresenter $presenter)
    {
        $requestArray = ['id' => $id];
        return RemoverRegistroFacade::execute($requestArray, $useCase, $presenter);
    }
}
