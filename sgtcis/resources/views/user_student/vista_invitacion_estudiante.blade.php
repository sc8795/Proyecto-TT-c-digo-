@extends('layout_administrador')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Invitación a tutoría</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_student.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                    <span class="tit_datos">{{$user_invita->name}} {{$user_invita->lastname}}, te ha invitado unirte a tutoría</span>
                </div>
                <div class="container" id="contenedor_general_op2">
                    <br>
                    <span class="negrita">Datos de tutoría a unirte</span>
                    <hr>
                    <span class="negrita">Día: <span class="quita_negrita">{{$solitutoria->dia}}</span></span> <br>
                    <span class="negrita">Horario de atención: <span class="quita_negrita">{{$solitutoria->hora_inicio}}:{{$solitutoria->minutos_inicio}} a {{$solitutoria->hora_fin}}:{{$solitutoria->minutos_fin}}</span></span> <br>
                    <span class="negrita">Modalidad: <span class="quita_negrita">{{$solitutoria->modalidad}}</span></span><br>
                    <span class="negrita">Tipo: <span class="quita_negrita">{{$solitutoria->tipo}}</span></span><br>
                    <span class="negrita">Motivo: <span class="quita_negrita">{{$solitutoria->motivo}}.</span></span>
                    <hr>
                    <a href="{{url("confirmar_invitacion/{$solitutoria->id}/{$id_notificacion}")}}" class="btn btn-success btn-sm">Confirmar invitación</a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ventana">Cancelar invitación</button>
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
                                    Si cancela la invitación el sistema eliminará la notificación recibida y su nombre no aparecerá en el registro del docente. Si está de acuerdo haga clic en Aceptar.
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
        </div>
    </div>
@endsection