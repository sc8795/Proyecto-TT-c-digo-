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
                <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                    <span class="tit_datos">Proceso de evaluación al estudiante {{$user_estudiante->name}} {{$user_estudiante->lastname}}</span>
                </div>
                <div class="container" id="contenedor_general_op2"> 
                    <br>
                        Conteste la/s siguiente/s pregunta/s:
                        <br>
                        <span class="negrita">
                            ¿El estudiante asistió a la tutoría?
                        </span>
                        <div class="container">
                            <div class="row">
                                <div class="col-1">
                                    <input type="radio" name="asistencia" onclick="asistencia();"> Si
                                </div>
                                <div class="col-1">
                                    <input type="radio" name="asistencia" onclick="asistencia();"> No
                                </div>
                            </div>
                            <div class="input-group mb-3" id="asistencia_si" style="display:none;">
                                <span class="negrita">
                                    1. ¿Considera que el estudiante lee el material (artículos, libros, documentos) facilitado o recomendado en clase?
                                </span>
                                <div class="container">
                                    <h6><input type="radio" name="" id=""> Totalmente de acuerdo </h6>
                                    <h6><input type="radio" name="" id=""> De acuerdo </h6>
                                    <h6><input type="radio" name="" id=""> Indeciso </h6>
                                    <h6><input type="radio" name="" id=""> En desacuerdo </h6>
                                    <h6><input type="radio" name="" id=""> Totalmente en desacuerdo </h6>
                                </div>
                                <span class="negrita">
                                    2. ¿El conocimiento previo del estudiante sobre el tema de tutoría fué?
                                </span>
                                <div class="container">
                                    <h6><input type="radio" name="" id=""> Muy alto </h6>
                                    <h6><input type="radio" name="" id=""> Alto </h6>
                                    <h6><input type="radio" name="" id=""> Medio </h6>
                                    <h6><input type="radio" name="" id=""> Bajo </h6>
                                    <h6><input type="radio" name="" id=""> Muy bajo </h6>
                                </div>
                                <span class="negrita">
                                    3. ¿El interés y disposición del estudiante durante la tutoría fué?
                                </span>
                                <div class="container">
                                    <h6><input type="radio" name="" id=""> Muy alto </h6>
                                    <h6><input type="radio" name="" id=""> Alto </h6>
                                    <h6><input type="radio" name="" id=""> Medio </h6>
                                    <h6><input type="radio" name="" id=""> Bajo </h6>
                                    <h6><input type="radio" name="" id=""> Muy bajo </h6>
                                </div>
                                <span class="negrita">
                                    4. ¿El desempeño (preguntó sobre nuevas dudas del tema) del estudiante durante la tutoría fué?
                                </span>
                                <div class="container">
                                    <h6><input type="radio" name="" id=""> Muy alto </h6>
                                    <h6><input type="radio" name="" id=""> Alto </h6>
                                    <h6><input type="radio" name="" id=""> Medio </h6>
                                    <h6><input type="radio" name="" id=""> Bajo </h6>
                                    <h6><input type="radio" name="" id=""> Muy bajo </h6>
                                </div>
                                <span class="negrita">
                                    5. En general ¿cómo califica la participación del estudiante durante la tutoría?
                                </span>
                                <div class="container">
                                    <h6><input type="radio" name="" id=""> Muy alto </h6>
                                    <h6><input type="radio" name="" id=""> Alto </h6>
                                    <h6><input type="radio" name="" id=""> Medio </h6>
                                    <h6><input type="radio" name="" id=""> Bajo </h6>
                                    <h6><input type="radio" name="" id=""> Muy bajo </h6>
                                </div>
                            </div>
                        </div>
                    <br>
                </div>
                <div class="input-group mb-3" id="asistencia_no" style="display:none;">
                    <div class="input-group-prepend">
                        <form action="{{url("evaluacion_estudiante/{$user_estudiante->id}")}}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-info btn-sm" name="asistencia" value="no">Enviar <span class="fas fa-times-circle"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection