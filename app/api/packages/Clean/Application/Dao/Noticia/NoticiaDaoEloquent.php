<?php

namespace Packages\Clean\Application\Dao\Noticia;

use App\Factory\GenericFactory;
use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Application\Helper\RepositoryHelper;
use Packages\Clean\Application\Responses\Dto\RepositoryDTO;
use Packages\Clean\Domain\Entities\Noticia;
use Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository;
use Packages\Clean\Domain\ValueObjects\Paginacao;

class NoticiaDaoEloquent extends NoticiaRepository {

    private $genericFactory;

    public function __construct(GenericFactory $genericFactory)
    {
        $this->genericFactory = $genericFactory;
    }

    public function obterNoticias(Paginacao $paginacao = null, $limiteDeRegistros) : RepositoryDTO
    {
        $repositoryDTO = $this->genericFactory->getInstance(RepositoryDTO::class);

        try {

            $temPaginacao = !is_null($paginacao);
            $temLimiteDeRegistros = !is_null($limiteDeRegistros);
            $noticias = Noticia::addSelect('*');

            if($temLimiteDeRegistros)
                $noticias = $noticias->limit($limiteDeRegistros);

            $noticias = $noticias->orderBy('id', 'DESC');

            if($temPaginacao)
                $noticias = $noticias->paginate($paginacao->getRegistrosPorPagina());
            else
                $noticias = $noticias->get();

            $noticias = $noticias->toArray();
            $repositoryDTO = RepositoryHelper::montarRetornoRepository($repositoryDTO, $noticias);

        } catch(\Exception $e) {
            throw new CleanException($e->getMessage());
        }

        return $repositoryDTO;
    }

    public function obterNoticia($id) : Array
    {
        try {

            $nomeTabela = Noticia::NOME_TABELA;
            $noticia = Noticia::where("{$nomeTabela}.id", $id)
                            ->addSelect('*')
                            ->first();

            if(is_null($noticia))
                throw new CleanException("Não foi possível localizar a notícia solicitada.");

            $noticia = $noticia->toArray();
            return $noticia;

        } catch(CleanException $e) {
            throw $e;
        } catch(\Exception $e) {
            throw new CleanException($e->getMessage());
        }
    }

    public function removerNoticia($id)
    {
        try {

            $noticia = Noticia::find($id);

            if(is_null($noticia))
                throw new CleanException("Não foi possível localizar a notícia solicitada.");

            $noticia->delete();

        } catch(CleanException $e) {
            throw $e;
        } catch(\Exception $e) {
            throw new CleanException($e->getMessage());
        }
    }
}
