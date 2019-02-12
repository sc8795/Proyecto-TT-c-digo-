@extends('layout_administrador')

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
                        <form method="POST" action="{{route('logout_administrador')}}" class="boton_logout">
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-block">Cerrar Sesion</button>
                        </form>
                    </div>
                </div>
            </div>
        <!--/nav-->
    </header>
@endsection
@section('content2')

        <div class="row">
            <div class="col-3">
                <div class="vertical-menu">
                    <div class="centrar_img_usuario_logueo">
                        <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
                    </div>
                    <a href="{{route('vista_general_admin')}}">Vista general de la cuenta</a>
                    <a href="#">Editar perfil</a>
                    <a href="{{route('registrar_docente')}}">Registrar docente</a>
                </div>
            </div>
            <div class="col-9">
                <div class="container" id="vista_general_cuenta">
                    <h3>Vista general de la cuenta</h3>
                    <hr>
                </div>
                <div class="container" id="vista_general_cuenta_tabla">
                    <h4>Perfil</h4>
                    <br>
                    <h6 class="tit_general">Usuario:</h6>
                    <h6 class="tit_datos">&nbsp; &nbsp; &nbsp;{{ auth()->user()->name }}&nbsp; {{ auth()->user()->lastname }}</h6>
                    <hr>
                    <h6 class="tit_general">Email:</h6>
                    <h6 class="tit_datos">&nbsp; &nbsp; &nbsp;{{ auth()->user()->email }}</h6>
                    <hr>
                </div>
            </div>    
        </div>
@endsection