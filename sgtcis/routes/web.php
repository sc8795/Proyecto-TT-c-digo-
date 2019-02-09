<?php

Route::get('/', function () {
    return view('welcome');
});

/* 
|--------------------------------------------------------------------------
| Rutas para el inicio de sesion de administrador
|--------------------------------------------------------------------------
*/
/*Ruta para la vista del formulario de inicio de sesion del administrador, para lo cual se crea el metodo show_login_form (mostrar formulario de inicio de sesion) que se encuentra en el archivo LoginController */
Route::get('/administrator','Auth\LoginController@show_login_form')->name('show_login_form');
/*Ruta privada para el usuario administrador que inician sesion*/
Route::get('auth_admin','AuthAdministradorController@index')->name('auth_admin');

/*Ruta del formulario login_administrador: se debe crear el metodo login_administrador*/
Route::post('login_administrador','Auth\LoginController@login_administrador')->name('login_administrador');

Route::post('logout_administrador','Auth\LoginController@logout_administrador')->name('logout_administrador');