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
                    <a href="#">Vista general de la cuenta</a>
                    <a href="#">Registrar docente</a>
                </div>
            </div>
            <div class="col-9">
                <div class="vista_general_cuenta">
                    <h3>Vista general de la cuenta</h3>
                </div>
            </div>
        </div>
    
@endsection