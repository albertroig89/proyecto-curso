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

Route::get('/', function () {
    return 'Home';
});

Route::get('/menu', 'UserController@menu');

Route::get('/usuarios', 'UserController@index');

//usuarios/nuevo != usuarios/[0-9]+  EL WHERE ARA ENS DIFERENCIA ENTRE SI LI DONEM UN NUMERO O NO PERQUE SINO MAI ENS ENTRARA A LA NOVA FUNCIO
//TAMBE TINDRE EN COMPTE QUE SI EN LLOC DEL WHERE CAMBIEM L'ORDRE DE LES FUNCIONS TAMBE ENS FARIA EL MATEIX

Route::get('/usuarios/{id}', 'UserController@show')
        ->where('id', '[0-9]+');
 //->here('id', '\d+'); ES EL MATEIX QUE LA LINEA ANTERIOR EL + SIGNIFICA QUE HI POT HABER MES D'UN NUMERO

Route::get('/usuarios/nuevo', 'UserController@create');

Route::get('/usuarios/{id}/edit', 'UserController@edit')
        ->where('id', '\d+');

Route::get('/saludo/{name}', 'WelcomeUserController@index');  //AL POSAR EL ? DESPRES DEL CAMP EL FEM OPCIONAL

Route::get('/saludo/{name}/{nickname}', 'WelcomeUserController@index2');