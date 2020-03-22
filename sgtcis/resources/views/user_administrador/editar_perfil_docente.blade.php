@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_admin")}}" title="Vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Editar docente</span>
                </h1>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                <hr>
                <div class="container">
                    <form class="formulario_general" method="POST" action="{{url("editar_docente/{$user_docente->id}")}}">
                        {{method_field("PUT")}}
                        {{ csrf_field() }}
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="txt_opcion_menu_vertical">Nombres</span>
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name',$user_docente->name)}}">
                        </div>
                        <hr>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="txt_opcion_menu_vertical">Apellidos</span>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="{{old('lastname',$user_docente->lastname)}}">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label><h6 class="tit_general">Contraseña</h6></label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
                    </form>
                    <br>
                </div>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection