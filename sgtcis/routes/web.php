<?php

Route::get('/', function () {
    return view('welcome');
});
/* Rutas para registro e inicio de sesión con cuenta de Google */
Route::get('student/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('student/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

/* 
|--------------------------------------------------------------------------
| Rutas para el inicio de sesion de administrador
|--------------------------------------------------------------------------
*/
/*Ruta para la vista del formulario de inicio de sesion del administrador, para lo cual se crea el metodo show_login_form (mostrar formulario de inicio de sesion) que se encuentra en el archivo LoginController */
Route::get('/administrator','Auth\LoginController@show_login_form')->name('show_login_form');
/*Ruta privada para el usuario administrador que inician sesion*/
Route::get('auth_admin','AuthAdministradorController@auth_admin')->name('auth_admin');

/*Ruta del formulario login_administrador: se debe crear el metodo login_administrador*/
Route::post('login_administrador','Auth\LoginController@login_administrador')->name('login_administrador');
/*Ruta para cerrar sesión del administrador*/
Route::post('logout_administrador','Auth\LoginController@logout_administrador')->name('logout_administrador');

/* 
|--------------------------------------------------------------------------
| Rutas para el inicio de sesion del estudiante
|--------------------------------------------------------------------------
*/
Route::get('/student','Auth\LoginController@show_login_form_student')->name('show_login_form_student')->middleware('guest');

Route::get('auth_student','AuthStudentController@auth_student')->name('auth_student');

Route::post('login_student','Auth\LoginController@login_student')->name('login_student');

Route::post('logout_student','Auth\LoginController@logout_student')->name('logout_student');

Route::get('verifica_cuenta_google','Auth\LoginController@verifica_cuenta_google')->name('verifica_cuenta_google');

/* 
|--------------------------------------------------------------------------
| Rutas para el inicio de sesion del docente
|--------------------------------------------------------------------------
*/
Route::get('/docente','Auth\LoginController@show_login_form_docente')->name('show_login_form_docente')->middleware('guest');

Route::get('auth_docente','AuthDocenteController@auth_docente')->name('auth_docente');

Route::post('login_docente','Auth\LoginController@login_docente')->name('login_docente');

Route::post('logout_docente','Auth\LoginController@logout_docente')->name('logout_docente');

/* 
|--------------------------------------------------------------------------
| RUTAS DEL ADMINISTRADOR 
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
Route::post('registrar_docente_excel','AuthAdministradorController@registrar_docente_excel')->name('registrar_docente_excel');

/* Rutas para visualizar los docentes registrados */
Route::get('docentes_registrados','AuthAdministradorController@docentes_registrados')->name('docentes_registrados');

/* Rutas para editar datos de un docente registrado */
Route::get('editar_perfil_docente/{user}','AuthAdministradorController@editar_perfil_docente')->name('editar_perfil_docente');
Route::put('editar_docente/{user}','AuthAdministradorController@editar_docente')->name('editar_docente');

/* Rutas para eliminar un docente registrado */
Route::delete('eliminar_docente/{user}','AuthAdministradorController@eliminar_docente')->name('eliminar_docente');

/* Rutas para registrar una materia */
Route::get('registrar_materia','AuthAdministradorController@registrar_materia')->name('registrar_materia');
Route::post('crear_materia','AuthAdministradorController@crear_materia')->name('crear_materia');
Route::post('registrar_materia_excel','AuthAdministradorController@registrar_materia_excel')->name('registrar_materia_excel');

/* Rutas para descargar plantillas excel (para registrar materia y docentes) */
Route::get('descargar_plantilla/{aux}','AuthAdministradorController@descargar_plantilla')->name('descargar_plantilla');

/* Rutas para visualizar las materias registradas */
Route::get('materias_registradas','AuthAdministradorController@materias_registradas')->name('materias_registradas');

/* Rutas para buscar una materia registrada por nombre, ciclo o paralelo */
Route::get('buscar_materia','AuthAdministradorController@buscar_materia')->name('buscar_materia');

/* Rutas para editar una materia registrada */
Route::get('editar_materia/{materia}','AuthAdministradorController@editar_materia')->name('editar_materia');
Route::put('editando_materia/{materia}','AuthAdministradorController@editando_materia')->name('editando_materia');

/* Rutas para eliminar una materia registrada */
Route::delete('eliminar_materia/{materia}','AuthAdministradorController@eliminar_materia')->name('eliminar_materia');

/* Rutas para asignar horario de tutoría al docente */
Route::get('asignar_horario_tutoria','AuthAdministradorController@asignar_horario_tutoria')->name('asignar_horario_tutoria');
Route::post('asignar_horario_docente/{user}','AuthAdministradorController@asignar_horario_docente')->name('asignar_horario_docente');
Route::post('asignar_horario/{user}','AuthAdministradorController@asignar_horario')->name('asignar_horario');
Route::post('asignar_horario_btn_docente/{user}','AuthAdministradorController@asignar_horario_btn_docente')->name('asignar_horario_btn_docente');

/* Rutas para visualizar horario de tutorías asignadas */
Route::get('horario_tutoria_asignada/{user}','AuthAdministradorController@horario_tutoria_asignada')->name('horario_tutoria_asignada');
Route::get('horario_tutoria_asignada_op2/{user}','AuthAdministradorController@horario_tutoria_asignada_op2')->name('horario_tutoria_asignada_op2');

/* Rutas para eliminar horario de tututoria asignada */
Route::delete('eliminar_horario_tutoria_asignada_op1/{user}','AuthAdministradorController@eliminar_horario_tutoria_asignada_op1')->name('eliminar_horario_tutoria_asignada_op1');
Route::delete('eliminar_horario_tutoria_asignada_op2/{user}','AuthAdministradorController@eliminar_horario_tutoria_asignada_op2')->name('eliminar_horario_tutoria_asignada_op2');
Route::delete('eliminar_horario_tutoria_asignada_op3/{user}','AuthAdministradorController@eliminar_horario_tutoria_asignada_op3')->name('eliminar_horario_tutoria_asignada_op3');
Route::delete('eliminar_horario_tutoria_asignada_op4/{user}','AuthAdministradorController@eliminar_horario_tutoria_asignada_op4')->name('eliminar_horario_tutoria_asignada_op4');
Route::delete('eliminar_horario_tutoria_asignada_op5/{user}','AuthAdministradorController@eliminar_horario_tutoria_asignada_op5')->name('eliminar_horario_tutoria_asignada_op5');
Route::get('eliminar_horario_tutoria_asignada_op1_1/{user}','AuthAdministradorController@eliminar_horario_tutoria_asignada_op1_1')->name('eliminar_horario_tutoria_asignada_op1_1');

/* Rutas para editar horario de tutoría asignada */
Route::get('vista_editar_horario_tutoria_asignada_op1/{user}/{aux}','AuthAdministradorController@vista_editar_horario_tutoria_asignada_op1')->name('vista_editar_horario_tutoria_asignada_op1');
Route::get('vista_editar_horario_tutoria_asignada_op2/{user}/{aux}','AuthAdministradorController@vista_editar_horario_tutoria_asignada_op2')->name('vista_editar_horario_tutoria_asignada_op2');
Route::get('vista_editar_horario_tutoria_asignada_op3/{user}/{aux}','AuthAdministradorController@vista_editar_horario_tutoria_asignada_op3')->name('vista_editar_horario_tutoria_asignada_op3');
Route::get('vista_editar_horario_tutoria_asignada_op4/{user}/{aux}','AuthAdministradorController@vista_editar_horario_tutoria_asignada_op4')->name('vista_editar_horario_tutoria_asignada_op4');
Route::get('vista_editar_horario_tutoria_asignada_op5/{user}/{aux}','AuthAdministradorController@vista_editar_horario_tutoria_asignada_op5')->name('vista_editar_horario_tutoria_asignada_op5');
Route::put('editando_horario/{user}','AuthAdministradorController@editando_horario')->name('editando_horario');
Route::get('mensaje_editar_horario/{user}','AuthAdministradorController@mensaje_editar_horario')->name('mensaje_editar_horario');
/* 
|--------------------------------------------------------------------------
| Rutas del Estudiante
|--------------------------------------------------------------------------
*/
/* Ruta para la vista general */
Route::get('vista_general_student','AuthStudentController@vista_general_student')->name('vista_general_student');

/* Ruta para la vista general del estudiante logueado o registrado con cuenta de google */
Route::get('vista_student_google/{user_id}','AuthStudentController@vista_student_google')->name('vista_student_google');

/* Rutas para editar perfil */
Route::get('editar_perfil_student','AuthStudentController@editar_perfil_student')->name('editar_perfil_student');
Route::put('editar_student','AuthStudentController@editar_student')->name('editar_student');

/* Rutas para solicitar tutoria*/
Route::get('solicitar_tutoria','AuthStudentController@solicitar_tutoria')->name('solicitar_tutoria');
Route::get('vista_solicitar_tutoria/{user}/{user_docente}/{materia}','AuthStudentController@vista_solicitar_tutoria')->name('vista_solicitar_tutoria');
Route::post('solicitar_tutoria_student/{user}/{user_docente}/{materia}/{estado}','AuthStudentController@solicitar_tutoria_student')->name('solicitar_tutoria_student');

/* Rutas para ver la tutoria confirmada por parte del docente*/
Route::get('ver_tutoria_confirmada/{user_docente_id}/{user_student_id}','AuthStudentController@ver_tutoria_confirmada')->name('ver_tutoria_confirmada');

/* Ruta para completar el registro del estudiante logueado o registrado con cuenta de google */
Route::put('save_completar_registro','AuthStudentController@save_completar_registro')->name('save_completar_registro');

/* Rutas para botón omitir cuando el estudiante está logueado o registrado con cuenta de google */
Route::get('omitir_completar_registro','AuthStudentController@omitir_completar_registro')->name('omitir_completar_registro');

/* 
|--------------------------------------------------------------------------
| Rutas del Docente
|--------------------------------------------------------------------------
*/
/* Rutas para la vista general de la cuenta*/
Route::get('vista_general_docente','AuthDocenteController@vista_general_docente')->name('vista_general_docente');

/* Rutas para editar perfil del docente */
Route::get('editar_perfil_docente','AuthDocenteController@editar_perfil_docente')->name('editar_perfil_docente');
Route::put('editar_docente','AuthDocenteController@editar_docente')->name('editar_docente');

/* Rutas para ver la tutoria solicitada por parte del estudiante*/
Route::get('ver_tutoria_solitada/{user_student_id}/{user_docente_id}/{solitutoria_id}','AuthDocenteController@ver_tutoria_solitada')->name('ver_tutoria_solitada');

/* Rutas para confirmar tutoria */
Route::put('confirmar_tutoria/{datos_tut}/{estudiante}/{docente}/{materia}','AuthDocenteController@confirmar_tutoria')->name('confirmar_tutoria');

/* Rutas para editar datos de tutoría solicitada */
Route::get('vista_editar_datos_tutoria/{datos_tut}/{estudiante}/{docente}/{materia}','AuthDocenteController@vista_editar_datos_tutoria')->name('vista_editar_datos_tutoria');
route::put('editar_datos_tutoria/{datos_tut}/{estudiante}/{docente}/{materia}','AuthDocenteController@editar_datos_tutoria')->name('editar_datos_tutoria');

/* Rutas para evaluar al estudiante */
Route::get('evaluar_estudiante/{user_docente_id}','AuthDocenteController@evaluar_estudiante')->name('evaluar_estudiante');
Route::get('lista_tutorias_confirmadas/{user_estudiante_id}/{user_docente_id}/{materia_id}','AuthDocenteController@lista_tutorias_confirmadas')->name('lista_tutorias_confirmadas');
Route::get('evalua_estudiante/{user_estudiante_id}/{user_docente_id}/{materia_id}','AuthDocenteController@evalua_estudiante')->name('evalua_estudiante');
Route::post('evaluacion_estudiante/{user_evaluado_id}','AuthDocenteController@evaluacion_estudiante')->name('evaluacion_estudiante');