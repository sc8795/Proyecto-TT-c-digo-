@extends('layout_pagina_inicio')

@section('content')
    <header>
        <!--nav class="navegacion"-->
            <div class="container-fluid" id="contenedor_header">
                <div class="row">
                    <div class="col-2">
                        <div class="logo">
                            <img src="{{asset('images/logo_sgtcis.png')}}" class="logo_imagen">
                        </div>
                    </div>
                    <div class="col-8">
        
                    </div>
                    <div class="col-2">
                        <ul class="menu">
                            <li>
                                <a href="#">Registrarse &nbsp;</a>
                            </li>
                            <li>
                                <a href="#" class="a_ini">Iniciar Sesión</a>
                                <ul class="submenu">
                                    <li>
                                    <a href="{{route('show_login_form_student')}}">Estudiante</a>
                                    </li>
                                    <li>
                                    <a href="{{route('show_login_form_docente')}}">Docente</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <!--/nav-->
    </header>
    <div class="container-fluid" id="espacio_menu_texto">
        
    </div>
    <div class="container-fluid" id="cont_pag_inicio">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-4">
                <h1 class="texto_formulario">Registro estudiante</h1>
                <div>
                    <form method="POST" action="registrar_estudiante.php">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombres completos">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Apellidos completos">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo institucional">
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label><h6 class="tit_ciclo_form">Ciclo</h6></label>
                            <br>
                            <div class="row">
                                <div class="col-4" for="gender">
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Primero"> Primero</h6> <br>
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Cuarto"> Cuarto</h6> <br>
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Séptimo"> Séptimo</h6> <br>
                                </div>
                                <div class="col-4">
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Segundo"> Segundo</h6> <br>
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Quinto"> Quinto</h6> <br>
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Octavo"> Octavo</h6> <br>
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Décimo"> Décimo</h6> <br>
                                </div>
                                <div class="col-4">
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Tercero"> Tercero</h6> <br>
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Sexto"> Sexto</h6> <br>
                                    <h6 class="radios"><input type="radio" name="gender" ide="gender" value="Noveno"> Noveno</h6> <br>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label><h6 class="tit_ciclo_form">Paralelo</h6></label>
                            <br>
                            <select name="paralelo" id="paralelo">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <hr>
                        <input type="submit" name="registrarse" class="btn btn-primary btn-block" value="Registrarse">
                        <br>
                        <div class="form-group">
                            <a href="{{ url('student/auth/google') }}" class="btn btn-google btn-danger btn-block"><i class="fab fa-google"></i> Registrarse con Google</a>
                         </div>
                    </form>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection