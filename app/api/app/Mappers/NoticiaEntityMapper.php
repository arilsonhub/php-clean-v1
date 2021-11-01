<?php

namespace App\Mappers;

use AutoMapperPlus\CustomMapper\CustomMapper;
use DateTime;
use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Domain\Entities\Noticia;
use Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository;

class NoticiaEntityMapper extends CustomMapper {

    private $noticiaRepository;

    public function __construct(NoticiaRepository $noticiaRepository)
    {
        $this->noticiaRepository = $noticiaRepository;
    }

    public function mapToObject($source, $noticia, Array $context = [])
    {
        try{
            if(!is_array($source))
                throw new \Exception("[NoticiaModelMapper] - Source precisa ser um Array");

            $primaryKeyName = $noticia->obterNomeDaChavePrimaria();

            if(array_key_exists($primaryKeyName, $source))
            {
                if(is_null($source[$primaryKeyName]))
                    unset($source[$primaryKeyName]);
                else
                    $noticia = $this->noticiaRepository->obterPeloId($source[$primaryKeyName], Noticia::class);
            }

            $noticia->setTitulo($source['titulo']);
            $noticia->setData(new DateTime($source['data']));

        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }

        return $noticia;
    }
}
