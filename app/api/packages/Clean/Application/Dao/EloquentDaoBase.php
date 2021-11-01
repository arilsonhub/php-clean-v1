<?php

namespace Packages\Clean\Application\Dao;

use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Domain\Repositories\RepositoryBase;

abstract class EloquentDaoBase extends RepositoryBase {


    public function adicionar($objeto)
    {
        try{
            $objeto->save();
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function obterPeloId($id, $objeto = null)
    {
        try{
            return $objeto->find($id);
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function obterTodos($objeto = null)
    {
        try{
            return $objeto->all();
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function atualizar($objeto)
    {
        try{
            $objeto->save();
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function remover($objeto)
    {
        try{
            $objeto->delete();
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }
}
