@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12" id="txt_opcion_menu_vertical">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Materias que imparte</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Por favor seleccione una materia para ver el registro de tutorías:</span></h4>
                <br>
                @if($materias->isNotEmpty())
                    @foreach ($materias as $materia)
                        @php
                            $verif_mat_sol=DB::table('solitutorias')
                                ->where('docente_id',auth()->user()->id)
                                ->where('materia_id',$materia->id)
                                ->where('fecha_tutoria','!=',null)
                                ->exists();
                        @endphp
                        @if ($verif_mat_sol==true)
                            <div class="container text-center" id="cont_carga_h">
                                <a href="{{url("ciclo/$materia->id")}}" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio">{{$materia->name}}</a>
                            </div>
                        @else
                            <div class="container text-center" id="cont_carga_h">
                                <button type="button" class="btn btn-dark btn-block btn-sm" disabled="disabled" id="borde_radio" title="No tiene tutorias tutorias confirmadas o solicitadas para esta materia">{{$materia->name}}</button>
                            </div>
                        @endif
                        <br>
                    @endforeach
                @else
                    <h6 id="txt_opcion_menu_vertical"><span class="negrita">No tiene carga horaria</span></h6>
                    <br>
                    <br>
                    <hr>
                    <a href="{{url("vista_general_docente")}}" class="btn btn-dark" id="borde_radio">Vista general de la cuenta</a>
                    <br>
                    <br>
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