<?php

namespace Packages\Clean\Application\Helper;

use App\Facade\AutoMapperFacade;
use Packages\Clean\Application\Responses\Dto\RepositoryDTO;

class RepositoryHelper {

    public static function montarRetornoRepository(RepositoryDTO $repositoryDTO, Array $dados) : RepositoryDTO
    {
        $temPaginacao = isset($dados['current_page']);

        if($temPaginacao)
        {
            $repositoryDTO->setDados($dados['data']);
            $repositoryDTO->setPaginaAtual($dados['current_page']);
            $repositoryDTO->setUltimaPagina($dados['last_page']);
            $repositoryDTO->setRegistrosPorPagina($dados['per_page']);
            $repositoryDTO->setTotalRegistros($dados['total']);
        }else
        {
            $repositoryDTO->setDados($dados);
        }

        return $repositoryDTO;
    }

    public static function converterDadosParaArray(RepositoryDTO &$repositoryDTO)
    {
        $dadosConvertidos = [];
        $dados = $repositoryDTO->getDados();

        foreach($dados as $entidade)
        {
            $entidadeArray = AutoMapperFacade::autoMap($entidade, []);
            $dadosConvertidos[] = $entidadeArray;
        }

        $repositoryDTO->setDados($dadosConvertidos);
    }
}
