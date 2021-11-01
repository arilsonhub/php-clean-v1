<?php

namespace App\Mappers;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Packages\Clean\Application\Exceptions\CleanException;

class EloquentModelToArrayMapper extends CustomMapper {

    public function mapToObject($source, $destination, Array $context = [])
    {
        try{
            $destination = $source->toArray();
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }

        return $destination;
    }
}
