<?php

namespace App\Providers\Clean\Noticia;

use App\Mappers\NoticiaEntityMapper;
use App\Mappers\NoticiaEntityToArrayMapper;
use AutoMapperPlus\DataType;
use Illuminate\Support\ServiceProvider;
use Packages\Clean\Domain\Entities\Noticia;
use Skraeda\AutoMapper\Support\Facades\AutoMapperFacade as AutoMapper;

class NoticiaServiceProvider extends ServiceProvider
{
    private $noticiaEntityMapper;
    private $noticiaEntityToArrayMapper;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Packages\Clean\Domain\Repositories\Noticia\NoticiaRepository', 'Packages\Clean\Application\Dao\Noticia\NoticiaDaoDoctrine');
        $this->app->bind('Packages\Clean\Domain\Validacao\Noticia\ValidacaoNoticia', 'Packages\Clean\Application\Validacao\Laravel\Noticia\ValidacaoNoticiaLaravel');
        $this->noticiaEntityMapper = $this->app->make(NoticiaEntityMapper::class);
        $this->noticiaEntityToArrayMapper = $this->app->make(NoticiaEntityToArrayMapper::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        AutoMapper::getConfiguration()
                  ->registerMapping(Noticia::class, DataType::ARRAY)
                  ->useCustomMapper($this->noticiaEntityToArrayMapper);

        AutoMapper::getConfiguration()
                  ->registerMapping(DataType::ARRAY, Noticia::class)
                  ->useCustomMapper($this->noticiaEntityMapper);
    }
}
