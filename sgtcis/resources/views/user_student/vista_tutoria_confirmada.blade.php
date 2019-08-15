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
                        $fecha=date_format($date, 'd-m-Y');
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
                            , el <span class="negrita">{{$fecha}}</span>.
                        </span>
                    </h6>
                    <h6 class="negrita">Lugar de tutoría: <span class="quita_negrita">Salón de clases</span></h6>
                    <h6 class="negrita">Motivo a tratar: <span class="quita_negrita">{{$datos_tut->motivo}}</span></h6>
                    <hr>
                    <div class="alert alert-primary" role="alert">
                        <h6>
                            <span class="negrita">¡Aviso!</span>
                            Una vez recibida la tutoría en el día acordado, el proceso finalizará cuando evalúe al docente sobre la tutoría impartida.
                            <br><br>
                            <!--a href="{{url("evaluar_docente/".auth()->user()->id."/{$notification}/{$datos_tut->id}/{$materia->id}/{$docente->id}")}}" class="btn btn-sm btn-outline-success">Evaluar docente</a-->
                            <button type="button" class="btn btn-dark btn-sm" disabled="disabled" id="borde_radio">Evaluar docente</button>
                        </h6>
                    </div>
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