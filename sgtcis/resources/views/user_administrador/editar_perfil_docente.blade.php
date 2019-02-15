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
        @include('user_administrador.vistas_iguales.menu_vertical')
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <form class="formulario_general" method="POST" action="{{url("editar_docente/{$user->id}")}}">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><h6 class="tit_general">Nombres</h6></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name',$user->name)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Apellidos</h6></label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="{{old('name',$user->lastname)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Correo Electrónico</h6></label>
                        <input type="email" class="form-control" name="email" id="email" value="{{old('name',$user->email)}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><h6 class="tit_general">Contraseña</h6></label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection