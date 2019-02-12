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
                <div class="container" id="registrar_docente">
                    <h3>Registrar docente</h3>
                    <hr>
                </div>
                <div class="container" id="registrar_docente_tabla">
                    <form class="form_registro_docente" method="POST" action="{{route('crear_docente')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label><h6 class="tit_general">Nombres</h6></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nombres completos">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label><h6 class="tit_general">Apellidos</h6></label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Apellidos completos">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label><h6 class="tit_general">Correo Electrónico</h6></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo institucional">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label><h6 class="tit_general">Contraseña</h6></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">Registrar docente</button>
                    </form>
                </div>
            </div>    
        </div>
@endsection