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
                    @php
                        $aux=2;
                    @endphp
                    <h4>Registro de docente por medio de documento excel</h4>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Descargar plantilla excel</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
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
                                        <div class="modal-body">
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
                                            <h6 class="negrita">password:
                                                <span class="quita_negrita">Contraseña para el inicio de sesión del docente.</span>
                                            </h6>
                                            <h6 class="negrita">is_admin:
                                                <span class="quita_negrita">Este campo sirve para identificar si el usuario a registrar va hacer administrador (se recomienda dejarlo en 0)</span>
                                            </h6>
                                            <h6 class="negrita">is_estudiante:
                                                <span class="quita_negrita">Este campo sirve para identificar si el usuario a registrar va hacer estudiante (se recomienda dejarlo en 0)</span>
                                            </h6>
                                            <h6 class="negrita">is_docente:
                                                <span class="quita_negrita">Este campo sirve para identificar si el usuario a registrar va hacer docente (se recomienda dejarlo en 1)</span>
                                            </h6>
                                            <h6 class="negrita">paralelo:
                                                <span class="quita_negrita">En este campo se recomienda escribir NA</span>
                                            </h6>
                                            <h6 class="negrita">ciclo:
                                                <span class="quita_negrita">En este campo se recomienda escribir NA</span>
                                            </h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerar</button>
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
                    </div>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                            <span class="tit_datos">Cargar documento excel</span>
                        </div>
                        <div class="container" id="contenedor_general_op2"> 
                            <br>
                            <form method="POST" action="{{route('registrar_docente_excel')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h6 class="excel"><input type="file" name="archivo"></h6><br>
                                <input type="submit" class="btn btn-primary btn-block" value="Registrar docente">
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection