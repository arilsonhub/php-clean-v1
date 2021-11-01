<?php

namespace App\Http\Middleware\Clean;

use Closure;
use LaravelDoctrine\ORM\Facades\EntityManager;

class TransactionalRoute
{
    public function handle($request, Closure $next)
    {
        $response = null;
        EntityManager::beginTransaction();

        try
        {
            $response = $next($request);

            if($response->exception)
                throw $response->exception;
        }
        catch (\Exception $e)
        {
            EntityManager::rollback();
            throw $e;
        }

        if($response->getStatusCode() > 399)
        {
            EntityManager::rollback();
            return $response;
        }

        $headerUndoTransaction = $response->headers->get('undo-transaction');

        if(!is_null($headerUndoTransaction))
        {
            EntityManager::rollback();
            $response->headers->remove('undo-transaction');
            return $response;
        }

        EntityManager::flush();
        EntityManager::commit();
        return $response;
    }
}
