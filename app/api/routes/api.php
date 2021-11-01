<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FallbackRouteController;
use App\Http\Controllers\Api\NoticiaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('noticias', [NoticiaController::class, 'listar']);
Route::get('noticias/noticia/{id}', [NoticiaController::class, 'obterNoticia']);

Route::middleware(['transactionalRoute'])->group(function () {
    Route::post('noticias/salvar', [NoticiaController::class, 'salvar']);
    Route::put('noticias/salvar', [NoticiaController::class, 'salvar']);
    Route::delete('noticias/remover/{id}', [NoticiaController::class, 'remover']);
});

Route::fallback([FallbackRouteController::class, 'fallback']);
