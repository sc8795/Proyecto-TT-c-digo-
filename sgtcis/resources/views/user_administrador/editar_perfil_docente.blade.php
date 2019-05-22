@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Editar perfil docente</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_administrador.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <form class="formulario_general" method="POST" action="{{url("editar_docente/{$user->id}")}}">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><h6 class="tit_general">Nombres</h6></label>
                        <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Apellidos</h6></label>
                        <input type="text" class="form-control" name="lastname" value="{{old('lastname',$user->lastname)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Correo Electrónico</h6></label>
                        <input type="email" class="form-control" name="email" value="{{old('email',$user->email)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Contraseña</h6></label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection