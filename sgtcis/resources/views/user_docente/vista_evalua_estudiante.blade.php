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
                        Conteste la siguiente pregunta:
                        <hr>
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
                                <hr>
                                <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                                    <span class="tit_datos">Preguntas de evaluación</span>
                                </div>
                                <div class="container" id="contenedor_general_op3"> 
                                    <br>
                                    Por favor conteste las siguientes preguntas:
                                    <hr>
                                    <span class="negrita"> Tema de tutoría
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            <input type="text" name="otro_motivo" placeholder="Escriba el tema general que trató la tutoría." class="form-control">
                                        </div>
                                    </span>
                                    <br>
                                    <span class="negrita"> Descripción de tutoría
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
                                            <textarea class="form-control" name="" id="" rows="2" placeholder="Describa el tema general de tutoría"></textarea>
                                        </div>
                                    </span>
                                    <hr>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Pregunta
                                                    <div class="hint--top-right hint--large" data-hint="La pregunta N° 1 tiene la siguiente valoración: &nbsp; &nbsp; &nbsp; &nbsp; - 5 (Totalmente de acuerdo equivale al 100%) &nbsp; &nbsp; &nbsp; &nbsp; - 4 (De acuerdo equivale al 75%) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - 3 (Indeciso equivale al 50%) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - 2 (En desacuerdo equivale al 25%) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - 1 (Totalmente en desacuerdo equivale al 0%)">
                                                        <span class="fas fa-question-circle"></span>
                                                    </div>                                                    
                                                </th>
                                                <th scope="col">5</th>
                                                <th scope="col">4</th>
                                                <th scope="col">3</th>
                                                <th scope="col">2</th>
                                                <th scope="col">1</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1. ¿Considera que el estudiante lee el material (artículos, libros, documentos) facilitado o recomendado en clase?</td>
                                                <td>
                                                    <span class="hint--bottom" data-hint="Totalmente de acuerdo">
                                                        <input type="radio" name="pr1">
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="hint--bottom" data-hint="De acuerdo">
                                                        <input type="radio" name="pr1">
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="hint--bottom" data-hint="Indeciso">
                                                        <input type="radio" name="pr1">
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="hint--bottom" data-hint="En desacuerdo">
                                                        <input type="radio" name="pr1">
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="hint--bottom" data-hint="Totalmente en desacuerdo">
                                                        <input type="radio" name="pr1">
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <br>
                </div>
                <div class="input-group mb-3" id="asistencia_no" style="display:none;">
                    <!--div class="input-group-prepend"-->
                        <form action="{{url("evaluacion_estudiante/{$user_estudiante->id}")}}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-sm btn-block" name="asistencia" value="no" title="Evaluar y registrar inasistencia del estudiante {{$user_estudiante->name}} {{$user_estudiante->lastname}}">Enviar <span class="fas fa-user-times"></span></button>
                        </form>
                    <!--/div-->
                </div>
            </div>
        </div>
    </div>
@endsection