<?php

namespace Packages\Clean\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

abstract class EntidadeBaseEloquent extends Model implements EntidadeBase {

    protected $connection = 'system';

    public $timestamps = false;

    abstract public function obterNomeDoObjetoDaEntidade();

    public function obterNomeDaChavePrimaria()
    {
        return $this->getKeyName();
    }

    public function obterValorDaChavePrimariaDaEntidade()
    {
        return $this->getKey();
    }

    public function obterNomeDaConexao()
    {
        return $this->connection;
    }

    public function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys))
        {
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName)
        {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    public function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }
}
