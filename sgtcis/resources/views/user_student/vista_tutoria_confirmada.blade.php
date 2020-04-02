@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Tutoría confirmada</span></h1>
                <hr>
                <div class="container" id="txt_opcion_menu_vertical">
                    <h6>
                        Los datos que se muestran a continuación corresponden al día, fecha y hora que recibirá la tutoría.
                    </h6>
                    <hr>
                    <h6 class="negrita">Materia: <span class="quita_negrita">{{$materia->name}}</span></h6>
                    <h6 class="negrita">Docente que impartirá la tutoría: <span class="quita_negrita">{{$docente->name}} {{$docente->lastname}}</span></h6>
                    @php
                        $fecha_tutoria=$datos_tut->fecha_tutoria;
                        $date = date_create($fecha_tutoria);
                        $fecha_tutoria=date_format($date, 'd-m-Y');
                        
                        $fecha_actual=now();
                        $date = date_create($fecha_actual);
                        $fecha_actual=date_format($date, 'd-m-Y');

                        $hora_actual=date("G");
                        $minuto_actual=date("i");
                                    
                    @endphp
                    <h6 class="negrita">La tutoría será realizada el día: 
                        <span class="quita_negrita">{{$datos_tut->dia}} de 
                            {{$datos_tut->hora_inicio}}:
                            @if ($datos_tut->minutos_inicio == "0")
                                {{$datos_tut->minutos_inicio}}0
                            @else
                                {{$datos_tut->minutos_inicio}}
                            @endif
                            a {{$datos_tut->hora_fin}}:
                            
                            @if ($datos_tut->minutos_fin == "0")
                                {{$datos_tut->minutos_fin}}0
                            @else
                                {{$datos_tut->minutos_fin}}
                            @endif
                            , el <span class="negrita">{{$fecha_tutoria}}</span>.
                        </span>
                    </h6>
                    <h6 class="negrita">Lugar de tutoría: <span class="quita_negrita">{{$datos_tut->lugar}}</span></h6>
                    <h6 class="negrita">Motivo a tratar: <span class="quita_negrita">{{$datos_tut->motivo}}</span></h6>
                    <hr>
                    @if ($fecha_tutoria==$fecha_actual)
                        @if ($datos_tut->hora_fin == $hora_actual)
                            @if ($datos_tut->minutos_fin > $minuto_actual)
                                <div class="alert alert-danger">
                                    <p>¡Aviso! El proceso finalizará cuando evalúe al docente sobre la tutoría recibida. El botón para evaluar al docente se activará una vez haya recibido 
                                        la tutoría en el día acordado. Por favor asegúrese de volver entrar a este enlace y evaluar al docente. 
                                    </p>
                                    <button type="button" class="hint--top btn-default" id="borde_radio" data-hint="Evaluar docente - desactivado" disabled="disabled">Evaluar docente</button>
                                </div>
                            @else
                                <div class="alert alert-success">
                                    <p>¡Aviso! El proceso finalizará cuando evalúe al docente sobre la tutoría recibida. El botón para evaluar al docente se encuentra activado.
                                        Por favor asegúrese de evaluar al docente haciendo clic en el botón "Evaluar docente".
                                    </p>
                                    <a href="{{url("evaluar_docente/".auth()->user()->id."/{$notification}/{$datos_tut->id}/{$materia->id}/{$docente->id}")}}" class="btn btn-outline-dark">Evaluar docente <span class="fas fa-check-circle"></span></a>
                                </div>
                            @endif
                        @else
                            @if ($datos_tut->hora_fin > $hora_actual)
                                <div class="alert alert-danger">
                                    <p>¡Aviso! El proceso finalizará cuando evalúe al docente sobre la tutoría recibida. El botón para evaluar al docente se activará una vez haya recibido 
                                        la tutoría en el día acordado. Por favor asegúrese de volver entrar a este enlace y evaluar al docente. 
                                    </p>
                                    <button type="button" class="hint--top btn-default" id="borde_radio" data-hint="Evaluar docente - desactivado" disabled="disabled">Evaluar docente</button>
                                </div>
                            @else
                                <div class="alert alert-success">
                                    <p>¡Aviso! El proceso finalizará cuando evalúe al docente sobre la tutoría recibida. El botón para evaluar al docente se encuentra activado.
                                        Por favor asegúrese de evaluar al docente haciendo clic en el botón "Evaluar docente".
                                    </p>
                                    <a href="{{url("evaluar_docente/".auth()->user()->id."/{$notification}/{$datos_tut->id}/{$materia->id}/{$docente->id}")}}" class="btn btn-outline-dark">Evaluar docente <span class="fas fa-check-circle"></span></a>
                                </div>
                            @endif
                        @endif
                    @else
                        @if ($fecha_tutoria > $fecha_actual)
                            <div class="alert alert-danger">
                                <p>¡Aviso! El proceso finalizará cuando evalúe al docente sobre la tutoría recibida. El botón para evaluar al docente se activará una vez haya recibido 
                                    la tutoría en el día acordado. Por favor asegúrese de volver entrar a este enlace y evaluar al docente. 
                                </p>
                                <button type="button" class="hint--top btn-default" id="borde_radio" data-hint="Evaluar docente - desactivado" disabled="disabled">Evaluar docente</button>
                            </div>
                        @else
                            <div class="alert alert-success">
                                <p>¡Aviso! El proceso finalizará cuando evalúe al docente sobre la tutoría recibida. El botón para evaluar al docente se encuentra activado.
                                    Por favor asegúrese de evaluar al docente haciendo clic en el botón "Evaluar docente".
                                </p>
                                <a href="{{url("evaluar_docente/".auth()->user()->id."/{$notification}/{$datos_tut->id}/{$materia->id}/{$docente->id}")}}" class="btn btn-outline-dark">Evaluar docente <span class="fas fa-check-circle"></span></a>
                            </div>
                        @endif
                    @endif
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

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection