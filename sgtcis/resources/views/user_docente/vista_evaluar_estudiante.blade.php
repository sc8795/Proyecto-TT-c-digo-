@extends('layout_docente')

@section('content')
    @include('user_docente.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_docente.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Evaluación al estudiante</h3>
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
                @if ($verifica==true)
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Lista de estudiantes que ha realizado tutoría</span>
                    </div>
                    <div class="container" id="contenedor_general_op2"> 
                        <br>
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Nombres completos</th>
                                    <th scope="col">Ciclo</th>
                                    <th scope="col">Paralelo</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            @foreach ($noti_estudiantes as $noti_estudiante)
                                @php
                                    $user_estudiante=DB::table('users')->where('id',$noti_estudiante->user_estudiante_id)->first();
                                @endphp 
                                <tbody>
                                    <tr>
                                        <td>{{$user_estudiante->name}} {{$user_estudiante->lastname}}</td>
                                        <td>{{$user_estudiante->ciclo}}</td>
                                        <td>{{$user_estudiante->paralelo}}</td>
                                        <td>Evaluar</td>
                                    </tr>
                                    <tr>
                                </tbody>
                            @endforeach
                        </table>
                        <br>
                    </div>
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
                    </h6>
                @endif
            </div>
        </div>
    </div>
@endsection