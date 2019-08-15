@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Solicitud de tutoría presencial - individual</span></h1>
                <br>
                <h5 id="txt_opcion_menu_vertical" class="text-justify">{{$estudiante->name}} {{$estudiante->lastname}} alumno del {{$estudiante->ciclo}} ciclo, paralelo
                        {{$estudiante->paralelo}} le ha solicitado tutoría con respecto a la materia  <span class="negrita">{{$materia->name}}</span> impartida por Ud.</span>
                </h5>
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
                    <input type="hidden" name="medio_virtual" value="{{$datos_tut->medio_virtual}}">
                    <input type="hidden" name="cuenta_virtual" value="{{$datos_tut->cuenta_virtual}}">
                    <input type="hidden" name="notificacion_id" value="{{$notificacion_id}}">
                
                    <div class="container" id="fondo_blanco">
                        <hr>
                        <div class="row" id="txt_opcion_menu_vertical">
                            <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                                <h6 class="negrita">Motivo: <span class="quita_negrita">{{$datos_tut->motivo}}.</span></h6>
                                <h6 class="negrita">Modalidad - Tipo: <span class="quita_negrita">{{$datos_tut->modalidad}} - {{$datos_tut->tipo}}</span></h6>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                                <h6 class="negrita">Horario: <span class="quita_negrita">{{$datos_tut->dia}} de {{$datos_tut->hora_inicio}}:{{$datos_tut->minutos_inicio}} a {{$datos_tut->hora_fin}}:{{$datos_tut->minutos_fin}}</span></h6>
                            </div>
                        </div>
                        <hr>
                        <h6 id="txt_opcion_menu_vertical"><span class="negrita">Fecha para impartir la tutoría</span></h6>
                        @if ($verifica_fecha_tutoria==true)
                            <div class="caja_error" id="caja_error">
                                <h6 class="titulo_error">{{$error}}</h6>
                            </div>
                        @endif
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-week"></i></span>
                            <input type="text" id="fecha" placeholder="Haga clic y seleccione la fecha para impartir la tutoría." class="form-control" name="fecha_tutoria" autocomplete="off">
                        </div>
                        <hr>
                    </div>
                    <button type="button" class="btn btn-outline-success" onclick="capturar_fecha();" id="borde_radio">Confirmar <i class="fas fa-check-circle"></i></button>  
                    <a href="{{url("vista_editar_datos_tutoria/{$datos_tut->id}/{$estudiante->id}/{$materia->id}/{$notificacion_id}")}}" class="btn btn-outline-primary " id="borde_radio" title="Editar datos de tutoría">Editar tutoría <span class="oi oi-pencil"></span></a>                    
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="cerrar">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- >Hasta aquí ventana modal<-->
                </form>
                <br>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_docente.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection