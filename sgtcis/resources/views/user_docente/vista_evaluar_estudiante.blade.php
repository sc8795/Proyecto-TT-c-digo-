@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Tutorías confirmadas</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Lista de tutorías confirmadas a los estudiantes</span></h4>
                <hr>
                @if ($verifica==true)
                    <div class="col-lg-12" id="txt_opcion_menu_vertical">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr> 
                                        <th scope="col">Estudiante que solicita</th>
                                        <th scope="col">Ciclo</th>
                                        <th scope="col">Paralelo</th>
                                        <th scope="col">Modalidad</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                @php
                                    $cont=0;
                                @endphp
                                @foreach ($unique_noti_estudiantes as $noti_estudiante)
                                    @php
                                        $user_estudiante=DB::table('users')->where('id',$noti_estudiante->user_estudiante_id)->first();
                                        $materia=DB::table('materias')->where('usuario_id',auth()->user()->id)->where('ciclo',$user_estudiante->ciclo)->first();
                                        $solitutoria=DB::table('solitutorias')->where('id',$noti_estudiante->solitutoria_id)->first();
                                        $v_evaluacion=DB::table('evaluacions')->where('solitutoria_id',$solitutoria->id)->where('user_evaluado_id',$user_estudiante->id)->exists();
                                    @endphp 
                                    <tbody>
                                        <tr>
                                            <td>{{$user_estudiante->name}} {{$user_estudiante->lastname}}</td>
                                            <td>{{$user_estudiante->ciclo}}</td>
                                            <td>{{$user_estudiante->paralelo}}</td>
                                            <td>{{$solitutoria->modalidad}}</td>
                                            <td>{{$solitutoria->tipo}}</td>
                                            <td>
                                                @if ($v_evaluacion==true)
                                                    <p style="background-color: #81c784" id="borde_radio" class="text-center">Tutoría evaluada</p>
                                                @else
                                                    <p style="background-color: #f78181" id="borde_radio" class="text-center">Tutoría por evaluar</p>
                                                @endif
                                            </td>
                                            <td><a href="{{url("lista_tutorias_confirmadas/{$user_estudiante->id}/".auth()->user()->id)."/{$materia->id}"}}" class="hint--top btn btn-outline-dark btn-sm" data-hint="Evaluar estudiante" id="borde_radio"><span class="fas fa-check-circle"></span></a></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @if ($unique_noti_estudiantes->count()==1)
                        <br><br><br>
                    @endif
                @else
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Aviso</span>
                    </div>
                    <div class="container" id="contenedor_general_op2"> 
                        <br>
                            Asegúrese de confirmar alguna tutoría solicitada por el estudiante, para poder evaluarlo.
                        <br>
                        <br>
                    </div>
                @endif
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_docente.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection 