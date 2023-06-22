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

//Users

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', 'UserController@menu')
    ->name('users');

Route::get('/usuarios', 'UserController@index')
    ->name('users.index');

//usuarios/nuevo != usuarios/[0-9]+  EL WHERE ARA ENS DIFERENCIA ENTRE SI LI DONEM UN NUMERO O NO PERQUE SINO MAI ENS ENTRARA A LA NOVA FUNCIO
//TAMBE TINDRE EN COMPTE QUE SI EN LLOC DEL WHERE CAMBIEM L'ORDRE DE LES FUNCIONS TAMBE ENS FARIA EL MATEIX

Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '[0-9]+')
    ->name('users.show');
 //->here('id', '\d+'); ES EL MATEIX QUE LA LINEA ANTERIOR EL + SIGNIFICA QUE HI POT HABER MES D'UN NUMERO

Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');

Route::post('/usuarios', 'UserController@store'); // PODEM POSAR 2 RUTES AL MATEIX LLOC PER DIFIRENTS METODOS "GET" I "POST"

Route::get('/usuarios/{user}/editar', 'UserController@edit')
        ->where('id', '\d+')
        ->name('users.edit');

Route::put('/usuarios/{user}', 'UserController@update');

Route::get('/saludo/{name}', 'WelcomeUserController@index');

Route::get('/saludo/{name}/{nickname}', 'WelcomeUserController@index2');

Route::get('/usuarios/papelera', 'UserController@trashed')
        ->name('users.trashed');

Route::patch('/usuarios/{user}/papelera', 'UserController@trash')
        ->name('users.trash');

Route::delete('/usuarios/{id}', 'UserController@destroy')
        ->name('users.destroy');

Route::get('usuarios/{id}/restaurar', 'UserController@restore')
    ->name('users.restore');

// Profile
Route::get('/editar-perfil/', 'ProfileController@edit')
    ->name('profiles.edit');

Route::put('/editar-perfil/', 'ProfileController@update');

// Professions
Route::get('/profesiones/', 'ProfessionController@index')
    ->name('professions.index');

Route::get('/profesiones/papelera', 'ProfessionController@trashed')
    ->name('professions.trashed');

Route::patch('/profesiones/{profession}/papelera', 'ProfessionController@trash')
    ->name('professions.trash');

Route::delete('/profesiones/{id}', 'ProfessionController@destroy')
    ->name('professions.destroy');

Route::get('profesiones/{id}/restaurar', 'ProfessionController@restore')
    ->name('professions.restore');

// Skills
Route::get('/habilidades/', 'SkillController@index')
    ->name('skills.index');

Route::get('/habilidades/papelera', 'SkillController@trashed')
    ->name('skills.trashed');

Route::patch('/habilidades/{skill}/papelera', 'SkillController@trash')
    ->name('skills.trash');

Route::delete('/habilidades/{id}', 'SkillController@destroy')
    ->name('skills.destroy');

Route::get('habilidades/{id}/restaurar', 'SkillController@restore')
    ->name('skills.restore');