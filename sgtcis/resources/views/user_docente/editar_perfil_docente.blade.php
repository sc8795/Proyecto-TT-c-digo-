@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_docente")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Editar perfil</span>
                </h1>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">
                            <form class="formulario_general" method="POST" action="{{url("editar_docente")}}">
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
                                    <input type="password" class="form-control" name="password" id="password" placeholder="********">
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-dark">Guardar perfil</button>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection