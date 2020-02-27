@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_admin")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Editar perfil</span>
                </h1>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>

                <form class="formulario_general" method="POST" action="{{url("editar_admin")}}">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="txt_opcion_menu_vertical">Nombres</span>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name',auth()->user()->name)}}">
                    </div>
                    <hr>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="txt_opcion_menu_vertical">Apellidos</span>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="{{old('lastname',auth()->user()->lastname)}}">
                    </div>
                    <hr>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="txt_opcion_menu_vertical">Contraseña</span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Escriba nueva contraseña">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark">Guardar perfil</button><br><br>
                </form>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection