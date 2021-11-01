<?php

namespace Packages\Clean\Application\Helper;

use Packages\Clean\Application\Responses\Dto\Cadastro\ListagemResponseDTO;
use Packages\Clean\Application\Responses\Dto\RepositoryDTO;

class UseCaseHelper {

    public static function copiarDadosRepositoryParaListagem(RepositoryDTO $repositoryDTO, ListagemResponseDTO $listagemResponseDTO) : ListagemResponseDTO {

        $listagemResponseDTO->setDados($repositoryDTO->getDados());
        $listagemResponseDTO->setUltimaPagina($repositoryDTO->getUltimaPagina());
        $listagemResponseDTO->setPaginaAtual($repositoryDTO->getPaginaAtual());
        $listagemResponseDTO->setRegistrosPorPagina($repositoryDTO->getRegistrosPorPagina());
        $listagemResponseDTO->setTotalRegistros($repositoryDTO->getTotalRegistros());

        return $listagemResponseDTO;
    }
}
