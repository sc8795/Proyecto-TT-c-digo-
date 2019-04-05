@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Registrar docente</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_administrador.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-6">
                    <div class="container" id="contenedor_general">
                        <form class="formulario_general" method="POST" action="{{route('crear_docente')}}">
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
                <div class="col-6">
                    <h4>Registro de docente por medio de documento excel</h4>
                    <form method="POST" action="{{route('registrar_docente_excel')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h6 class="excel"><input type="file" name="archivo"></h6><br>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection