<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('ofertas', 'OfertaController');

    Route::resource('usuarios', 'UsuarioController');

    Route::resource('mensagens', 'MensagemController');

    Route::get('mensagens/visualizar/{id}', 'MensagemController@visualizar')->name('mensagens.visualizar');

    Route::post('mensagens/responder', 'MensagemController@responder')->name('mensagens.responder');
});
