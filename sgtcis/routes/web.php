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
    return view('welcome');
});

/*Ruta para el módulo de administrador (iniciar_sesion)*/
Route::get('/administrator','UserAdministratorController@login_administrador')
    ->name('user_administrador.login_administrador');