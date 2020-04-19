@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_admin")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Registrar docente</span>
                </h1>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" id="mensaje_siete">
                        <ul>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </ul>
                    </div>
                @endif
                <hr>
                <div class="row">
                    <div class="col-6">
                        <h4><span class="negrita">Registro manual</span></h4>
                        <hr>
                        <form method="POST" action="{{route('crear_docente')}}" onsubmit="return valida_form_registro_docente();">
                            {{ csrf_field() }}
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="txt_opcion_menu_vertical">Nombres</span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombres completos">
                            </div>
                            <hr>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="txt_opcion_menu_vertical">Apellidos</span>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Apellidos completos">
                            </div>
                            <hr>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="txt_opcion_menu_vertical">Correo</span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Correo institucional">
                            </div>
                            <hr>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="txt_opcion_menu_vertical">Contraseña</span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-dark">Registrar docente</button><br><br>
                        </form>
                    </div>
                    <div class="col-6">
                        @php
                            $aux=2;
                        @endphp
                        <h4><span class="negrita">Registro por medio de documento excel</span></h4>
                        <hr>
                        <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Descargar plantilla excel</span>
                        </div>
                        <div class="container" style="border: 1px solid #000000;">
                            <br>
                            <!-- >Ventana modal<-->
                            <main class="container">
                                <div class="modal fade" id="ventana" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">  
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 id="tituloVentana">¡Detalles sobre la plantilla!</h5>
                                                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body justificar">
                                                <h6>Al descargar la plantilla, el documento excel tendrá los siguientes campos:</h6>
                                                <h6 class="negrita">nombres:
                                                    <span class="quita_negrita">Nombres completos del docente que desea registrar.</span>
                                                </h6>
                                                <h6 class="negrita">apellidos:
                                                        <span class="quita_negrita">Apellidos completos del docente que desea registrar.</span>
                                                    </h6>
                                                <h6 class="negrita">correo:
                                                    <span class="quita_negrita">Correo institucional del docente.</span>
                                                </h6>
                                                <h6 class="negrita">clave:
                                                    <span class="quita_negrita">Contraseña para el inicio de sesión del docente.</span>
                                                </h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                            <!-- >Hasta aquí ventana modal<-->
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ventana">Detalles</button>
                            <a href="{{url("descargar_plantilla/{$aux}")}}" class="btn btn-secondary btn-sm" title="Descargar plantilla para registro de materias por medio de documento excel">Descargar <span class="fas fa-file-excel"></span></a>
                            <br>
                            <br>
                            <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                                <span class="tit_datos">Cargar documento excel</span>
                            </div>
                            <div class="container"> 
                                <br>
                                <form method="POST" action="{{route('registrar_docente_excel')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <h6 class="excel"><input type="file" name="archivo"></h6><br>
                                    <input type="submit" class="btn btn-dark" value="Registrar docente">
                                </form>
                                <br>
                            </div>
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