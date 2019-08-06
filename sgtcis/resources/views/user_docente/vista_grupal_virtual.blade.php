@extends('layout_docente')

@section('content')
    @include('user_docente.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_docente.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista tutoría solicitada (virtual - grupal)</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_docente.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                @php
                    $mensaje_error="";
                    $verifica_fecha_tutoria=false;
                @endphp
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                        @php
                            $mensaje_error=$error;
                            $verifica_fecha_tutoria = str_contains($mensaje_error, 'fecha');
                        @endphp
                    @endforeach
                @endif
                <form action="{{url("confirmar_tutoria")}}" method="POST">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <input type="hidden" name="solitutoria_id" value="{{$datos_tut->id}}">
                    <input type="hidden" name="hora_inicio" value="{{$datos_tut->hora_inicio}}">
                    <input type="hidden" name="minutos_inicio" value="{{$datos_tut->minutos_inicio}}">
                    <input type="hidden" name="hora_fin" value="{{$datos_tut->hora_fin}}">
                    <input type="hidden" name="minutos_fin" value="{{$datos_tut->minutos_fin}}">
                    <input type="hidden" name="modalidad" value="{{$datos_tut->modalidad}}">
                    <input type="hidden" name="notificacion_id" value="{{$notificacion_id}}">
                    
                    <h6 class="tit_general">Asunto: 
                        <span class="tit_datos_op2">{{$estudiante->name}} {{$estudiante->lastname}} alumno del {{$estudiante->ciclo}} ciclo, paralelo
                            {{$estudiante->paralelo}} le ha solicitado tutoría con respecto a la materia  {{$materia->name}} impartida por Ud.
                        </span>
                    </h6>
                    <br>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Datos de tutoría</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <div class="row">
                            <div class="col-6">
                                @php
                                    $arreglo_est_inv=explode('.', $invitacion->user_invitado_id);
                                    $arreglo_confirmacion=explode('.', $invitacion->confirmacion);
                                @endphp
                                <span class="negrita"> Estudiantes participantes</span>
                                <hr>
                                <h6>- {{$estudiante->name}} {{$estudiante->lastname}}</h6>
                                @for ($i=0; $i < count($arreglo_confirmacion); $i++)
                                    @if ($arreglo_confirmacion[$i]=="si")
                                        @php
                                            $id_estudiante_inv=$arreglo_est_inv[$i];
                                            $estudiante_inv=DB::table('users')->where('id',$id_estudiante_inv)->first();
                                        @endphp
                                        <h6>- {{$estudiante_inv->name}} {{$estudiante_inv->lastname}}</h6>
                                    @endif
                                @endfor
                            </div>
                            <div class="col-6">
                                <h6 class="negrita">Horario: <span class="quita_negrita">{{$datos_tut->dia}} de {{$datos_tut->hora_inicio}}:{{$datos_tut->minutos_inicio}} a {{$datos_tut->hora_fin}}:{{$datos_tut->minutos_fin}}</span></h6>
                                <h6 class="negrita">Motivo: <span class="quita_negrita">{{$datos_tut->motivo}}.</span></h6>
                                <h6 class="negrita">Modalidad - Tipo: <span class="quita_negrita">{{$datos_tut->modalidad}} - {{$datos_tut->tipo}}</span></h6>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Datos de tutoría - fecha</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-week"></i></span>
                            <input type="text" id="fecha" placeholder="Haga clic y seleccione la fecha de tutoría." class="form-control" name="fecha_tutoria" autocomplete="off">
                        </div>
                        <br>
                    </div>
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Datos de tutoría - medio virtual</span>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ventana_ayuda"><i class="fas fa-question-circle"></i></button>
                    </div>
                    <div class="container" id="contenedor_general_op2">
                        <br>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-external-link-alt"></i></span>
                            <input type="text" id="medio_virtual" placeholder="Escriba el link del medio virtual de tutoría (p.e: https://www.skype.com/es/)" class="form-control" name="medio_virtual" autocomplete="off">
                        </div>
                        <br>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
                            <input type="text" id="cuenta_virtual" placeholder="Escriba el nombre de usuario o correo de su cuenta (medio virtual)" class="form-control" name="cuenta_virtual" autocomplete="off">
                        </div>
                        <br>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" onclick="capturar_virtual();">Confirmar <i class="fas fa-check-circle"></i></button>  
                    <a href="{{url("vista_editar_datos_tutoria/{$datos_tut->id}/{$estudiante->id}/{$materia->id}/{$notificacion_id}")}}" class="btn btn-primary btn-sm" title="Editar datos de tutoría">Editar tutoría <span class="oi oi-pencil"></span></a>                    
                    <!-- >Ventana modal<-->
                    <main class="container" id="ventana_2">
                        <div class="modal fade" id="ventana" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">  
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 id="tituloVentana">¡Aviso!</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Al confirmar, aceptará impartir la tutoría solicitada en el siguiente horario:</h6>
                                        <h6 class="negrita">Día: <span class="quita_negrita">{{$datos_tut->dia}}</span></h6>
                                        <h6 class="negrita">Fecha: <span class="quita_negrita" id="fecha_modal"></span><span class="quita_negrita"> de {{$datos_tut->hora_inicio}}:{{$datos_tut->minutos_inicio}} a {{$datos_tut->hora_fin}}:{{$datos_tut->minutos_fin}}</span></h6>
                                        <hr>
                                        Por favor asegúrese de conectarse al medio virtual que seleccionó en la fecha y hora indicada, para que pueda establecer la comunicación con los estudiantes participantes y dar
                                        lugar a la tutoría.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="cerrar">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- >Hasta aquí ventana modal<-->

                    <!-- >Ventana modal<-->
                    <main class="container" id="ventana_2">
                        <div class="modal fade" id="ventana_ayuda" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">  
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 id="tituloVentana">¡Ayuda!</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>A continuación se solicitan los siguientes campos:</h6>
                                        <h6 class="negrita">Medio virtual: <span class="quita_negrita">Corresponde al medio virtual en dónde se realizará la tutoría. Se recomienda
                                        skype como medio para poder realizarla (tiene medio de chat y videollamada, en dónde pueden participar más de dos personas). Este link, le 
                                        llegará a los estudiantes que participarán de la tutoría.</span></h6>
                                        <h6 class="negrita">Nombre de usuario o correo: <span class="quita_negrita">Si el medio elegido es skype, al registrarse necesitará de una
                                        cuenta de usuario (correo) para poder tener acceso. Este usuario es el que debe escribirlo, se lo recomienda porque facilitará a los estudiantes
                                        que participarán en la tutoría su búsqueda.</span></h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="cerrar">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- >Hasta aquí ventana modal<-->
                </form>  
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection