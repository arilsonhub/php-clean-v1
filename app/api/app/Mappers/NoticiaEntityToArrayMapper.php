<?php

namespace App\Mappers;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Packages\Clean\Application\Exceptions\CleanException;

class NoticiaEntityToArrayMapper extends CustomMapper {

    public function mapToObject($noticia, $noticiaArray, Array $context = [])
    {
        try{
            $noticiaArray = [
                'id'     => $noticia->obterValorDaChavePrimariaDaEntidade(),
                'titulo' => $noticia->getTitulo(),
                'data'   => $noticia->getData()->format('Y-m-d')
            ];
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }

        return $noticiaArray;
    }
}
