<?php

namespace App\Mappers;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Packages\Clean\Application\Exceptions\CleanException;

class EloquentModelMapper extends CustomMapper {

    public function mapToObject($source, $destination, Array $context = [])
    {
        try{
            if(!is_array($source))
                throw new \Exception("[EloquentModelMapper] - Source precisa ser um Array");

            $primaryKeyName = $destination->getKeyName();

            if(array_key_exists($primaryKeyName, $source))
            {
                if(is_null($source[$primaryKeyName]))
                    unset($source[$primaryKeyName]);
                else
                {
                    $destination = $destination->findOrFail($source[$primaryKeyName]);
                }
            }

            $destination->fill($source);

        }catch(ModelNotFoundException $e){
            throw new CleanException($e->getMessage());
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }

        return $destination;
    }
}
