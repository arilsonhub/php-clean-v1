<?php

namespace Packages\Clean\Application\Dao;

use LaravelDoctrine\ORM\Facades\EntityManager;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;
use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Domain\Repositories\RepositoryBase;

abstract class DoctrineDaoBase extends RepositoryBase {

    use PaginatesFromRequest;

    public function adicionar($objeto)
    {
        try{
            EntityManager::persist($objeto);
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function obterPeloId($id, $objeto = null)
    {
        try{
            return EntityManager::find($objeto, $id);
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function obterTodos($objeto = null)
    {
        try{
            $query = EntityManager::createQuery("select obj from {$objeto}");
            $lista = $query->getResult();
            return $lista;
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function atualizar($objeto)
    {
        try{
            EntityManager::merge($objeto);
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function remover($objeto)
    {
        try{
            EntityManager::remove($objeto);
        }catch(\Exception $e){
            throw new CleanException($e->getMessage());
        }
    }

    public function createQueryBuilder($alias, $indexBy = null)
    {
        return EntityManager::createQueryBuilder();
    }
}
