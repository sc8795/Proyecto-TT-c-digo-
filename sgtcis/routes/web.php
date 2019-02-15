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
/*Ruta para cerrar sesión del administrador*/
Route::post('logout_administrador','Auth\LoginController@logout_administrador')->name('logout_administrador');

/* 
|--------------------------------------------------------------------------
| Rutas para el inicio de sesion del estudiante
|--------------------------------------------------------------------------
*/
Route::get('/student','Auth\LoginController@show_login_form_student')->name('show_login_form_student');

Route::get('auth_student','AuthStudentController@index')->name('auth_student');

Route::post('login_student','Auth\LoginController@login_student')->name('login_student');

Route::post('logout_student','Auth\LoginController@logout_student')->name('logout_student');

/* 
|--------------------------------------------------------------------------
| Rutas para el inicio de sesion del docente
|--------------------------------------------------------------------------
*/
Route::get('/docente','Auth\LoginController@show_login_form_docente')->name('show_login_form_docente');

Route::get('auth_docente','AuthDocenteController@index')->name('auth_docente');

Route::post('login_docente','Auth\LoginController@login_docente')->name('login_docente');

Route::post('logout_docente','Auth\LoginController@logout_docente')->name('logout_docente');

/* 
|--------------------------------------------------------------------------
| Rutas del Administrador
|--------------------------------------------------------------------------
*/
/* Ruta para la vista general */
Route::get('vista_general_admin','AuthAdministradorController@vista_general_admin')->name('vista_general_admin');

/* Rutas para editar perfil del administrador */
Route::get('editar_perfil_admin','AuthAdministradorController@editar_perfil_admin')->name('editar_perfil_admin');
Route::put('editar_admin','AuthAdministradorController@editar_admin')->name('editar_admin');

/* Rutas para registrar un docente */
Route::get('registrar_docente','AuthAdministradorController@registrar_docente')->name('registrar_docente');
Route::post('crear_docente','AuthAdministradorController@crear_docente')->name('crear_docente');

/* Rutas para visualizar los docentes registrados */
Route::get('docentes_registrados','AuthAdministradorController@docentes_registrados')->name('docentes_registrados');

/* Rutas para editar datos de un docente registrado */
Route::get('editar_perfil_docente/{user}','AuthAdministradorController@editar_perfil_docente')->name('editar_perfil_docente');
Route::put('editar_docente/{user}','AuthAdministradorController@editar_docente')->name('editar_docente');

/* Rutas para eliminar un docente registrado */
Route::delete('eliminar_docente/{user}','AuthAdministradorController@eliminar_docente')->name('eliminar_docente');