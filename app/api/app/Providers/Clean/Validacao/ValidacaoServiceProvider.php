<?php

namespace App\Providers\Clean\Validacao;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ValidacaoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('iunique', function ($attribute, $value, $parameters, $validator) {
            if (isset($parameters[1])) {
                [$connection]  = $validator->parseTable($parameters[0]);
                $wrapped       = DB::connection($connection)->getQueryGrammar()->wrap($parameters[1]);
                $parameters[1] = DB::raw("replace(lower({$wrapped}),' ','')");
            }
            return $validator->validateUnique($attribute, str_replace(' ', '', Str::lower($value)), $parameters);
        }, trans('validation.iunique'));

    }
}
