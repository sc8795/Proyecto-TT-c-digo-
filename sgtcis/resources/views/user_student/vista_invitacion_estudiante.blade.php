@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Invitación</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">{{$user_invita->name}} {{$user_invita->lastname}}, te ha invitado unirte a tutoría</span></h4>
                <br>
                <div class="container" id="fondo_blanco">
                    <span class="negrita">Datos de tutoría a unirte</span>
                    <hr>
                    <span class="negrita">Día: <span class="quita_negrita">{{$solitutoria->dia}}</span></span> <br>
                    <span class="negrita">Horario de atención: <span class="quita_negrita">{{$solitutoria->hora_inicio}}:{{$solitutoria->minutos_inicio}} a {{$solitutoria->hora_fin}}:{{$solitutoria->minutos_fin}}</span></span> <br>
                    <span class="negrita">Modalidad: <span class="quita_negrita">{{$solitutoria->modalidad}}</span></span><br>
                    <span class="negrita">Tipo: <span class="quita_negrita">{{$solitutoria->tipo}}</span></span><br>
                    <span class="negrita">Motivo: <span class="quita_negrita">{{$solitutoria->motivo}}.</span></span>
                    @if ($solitutoria->fecha_solicita!=$solitutoria->fecha_tutoria && $solitutoria->fecha_tutoria!=null)
                        @php
                            $fecha_tutoria=$solitutoria->fecha_tutoria;
                            $date = date_create($fecha_tutoria);
                            $fecha_tutoria=date_format($date, 'd-m-Y');
                        @endphp
                        <hr>
                        <span class="negrita">Fecha que será impartida: <span class="quita_negrita">{{$fecha_tutoria}}.</span></span>
                    @endif
                    <hr>
                    <a href="{{url("confirmar_invitacion/{$solitutoria->id}/{$id_notificacion}")}}" class="btn btn-success btn-sm">Confirmar invitación</a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ventana">Cancelar invitación</button>
                    <hr>
                </div>
                    <!-- >Ventana modal<-->
                    <main class="container">
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
                                        Al cancelar la invitación el sistema automáticamente eliminará la notificación recibida. Si está de acuerdo haga clic en Aceptar.
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{url("cancela_invitacion/{$id_notificacion}")}}" class="btn btn-danger">Aceptar</a>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- >Hasta aquí ventana modal<-->
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

