<?php

namespace Packages\Clean\Application\Dao\Noticia;

use App\Facade\AutoMapperFacade;
use App\Factory\GenericFactory;
use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Application\Helper\RepositoryHelper;
use Packages\Clean\Application\Responses\Dto\RepositoryDTO;
use Packages\Clean\Domain\Entities\Noticia;
use Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository;
use Packages\Clean\Domain\ValueObjects\Paginacao;

class NoticiaDaoDoctrine extends NoticiaRepository {

    private $genericFactory;
    private $referenciaNoticia = Noticia::class;

    public function __construct(GenericFactory $genericFactory)
    {
        $this->genericFactory = $genericFactory;
    }

    public function obterNoticias(Paginacao $paginacao = null, $limiteDeRegistros) : RepositoryDTO
    {
        $repositoryDTO = $this->genericFactory->getInstance(RepositoryDTO::class);
        $listaNoticias = null;

        try
        {
            $queryBuilder = parent::createQueryBuilder(null);
            $queryBuilder->select('noticia')
                         ->from($this->referenciaNoticia, 'noticia')
                         ->orderBy('noticia.data', 'desc');

            if(!is_null($limiteDeRegistros))
                $queryBuilder->setMaxResults($limiteDeRegistros);

            if(!is_null($paginacao))
            {
                $dadosPaginacao = $this->paginate($queryBuilder->getQuery(), $paginacao->getRegistrosPorPagina(), $paginacao->getPaginaAtual());
                $listaNoticias = $dadosPaginacao->toArray();
            }
            else
                $listaNoticias = $queryBuilder->getQuery()->getResult();

            $repositoryDTO = RepositoryHelper::montarRetornoRepository($repositoryDTO, $listaNoticias);
            RepositoryHelper::converterDadosParaArray($repositoryDTO);
        }
        catch(\Exception $e)
        {
            throw new CleanException($e->getMessage());
        }

        return $repositoryDTO;
    }

    public function obterNoticia($id) : Array
    {
        try
        {
            $noticia = $this->obterPeloId($id, Noticia::class);
            $noticiaArray = AutoMapperFacade::autoMap($noticia, []);
            return $noticiaArray;
        }
        catch(\Exception $e)
        {
            throw new CleanException($e->getMessage());
        }
    }

    public function removerNoticia($id)
    {
        try
        {
            $noticia = $this->obterPeloId($id, Noticia::class);
            $this->remover($noticia);
        }
        catch(\Exception $e)
        {
            throw new CleanException($e->getMessage());
        }
    }
}
