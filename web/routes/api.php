<?php

header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");

use Illuminate\Http\Request;

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

 Route::get('user', function (Request $request) {
     return $request->user();
 })->middleware('auth:api');

Route::get('ofertas', function () {
    $ofertas = App\Oferta::all();
    foreach($ofertas as $oferta){
        $oferta->imagem = asset($oferta->imagem);
    }
    return response()->json($ofertas);
});

Route::get('users/{email}/{password}', 'ApiUsuarioController@getUsuario');
Route::get('usuarios', 'ApiUsuarioController@usuarios');

Route::get('mensagens/{id}', 'ApiMensagemController@mensagem');
Route::get('visualizar-mensagem/{id}', 'ApiMensagemController@visualizar');
Route::get('nova-mensagem', 'ApiMensagemController@novaMensagem');
Route::get('excluir-mensagem/{id}', 'ApiMensagemController@excluir');

