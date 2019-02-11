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
                                        <a href="#">Estudiante</a>
                                    </li>
                                    <li>
                                        <a href="#">Docente</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <!--/nav-->
    </header>
@endsection