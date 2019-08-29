@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_docente.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Evaluación estudiante</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Proceso de evaluación al estudiante {{$user_estudiante->name}} {{$user_estudiante->lastname}}</span></h4>
                <hr>
                <div class="container" id="contenedor_general_op2"> 
                    <br>
                        Conteste la siguiente pregunta:
                        <br><br>
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
                            <!--Asistencia = si-->
                            <div class="input-group mb-3" id="asistencia_si" style="display:none;">
                                <hr>                                
                                <form action="{{url("evaluacion_estudiante/{$user_estudiante->id}/{$solitutoria_id}")}}" method="POST" onsubmit="return validar_evaluacion_estudiante()">
                                    {{ csrf_field() }}
                                    <div class="d-flex p-2 bd-highlight" id="fondo_tabla_general">
                                        <span class="tit_datos">Preguntas de evaluación</span>
                                    </div>
                                    <div class="container" id="fondo_solicitud"> 
                                        <br>
                                        Por favor responda las siguientes preguntas:
                                        <hr>
                                        <span class="negrita"> Tema de tutoría
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                <input type="text" class="form-control" id="tema_de_tutoria" name="tema_de_tutoria" autocomplete="off" placeholder="Escriba el tema general que trató la tutoría.">
                                            </div>
                                        </span>
                                        <br>
                                        <span class="negrita"> Descripción de tutoría
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
                                                <textarea class="form-control" name="descripcion_de_tutoria" id="descripcion_de_tutoria" rows="2" autocomplete="off" placeholder="Describa el tema general de tutoría o las tareas que se abordaron durante la tutoría."></textarea>
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
                                                            <input type="radio" name="pr1" id="pr1" value="100">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="De acuerdo">
                                                            <input type="radio" name="pr1" id="pr1" value="75">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Indeciso">
                                                            <input type="radio" name="pr1" id="pr1" value="50">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="En desacuerdo">
                                                            <input type="radio" name="pr1" id="pr1" value="25">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Totalmente en desacuerdo">
                                                            <input type="radio" name="pr1" id="pr1" value="0"> 
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Preguntas
                                                        <div class="hint--top-right hint--large" data-hint="Las preguntas N° 2, 3, 4 y 5 tienen la siguiente valoración: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; - 5 (Muy alto equivale al 100%) &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; - 4 (Alto equivale al 75%) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; - 3 (Medio equivale al 50%) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - 2 (Bajo equivale al 25%) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; - 1 (Muy bajo equivale al 0%)">
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
                                                    <td>2. ¿El conocimiento previo del estudiante sobre el tema de tutoría fué?</td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy alto">
                                                            <input type="radio" name="pr2" id="pr2" value="100">
                                                        </span>
                                                    </td>
                                                    <td> 
                                                        <span class="hint--bottom" data-hint="Alto">
                                                            <input type="radio" name="pr2" id="pr2" value="75">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Medio">
                                                            <input type="radio" name="pr2" id="pr2" value="50">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Bajo">
                                                            <input type="radio" name="pr2" id="pr2" value="25">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy bajo">
                                                            <input type="radio" name="pr2" id="pr2"value="0">
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3. ¿El interés y disposición del estudiante durante la tutoría fué?</td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy alto">
                                                            <input type="radio" name="pr3" id="pr3" value="100">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Alto">
                                                            <input type="radio" name="pr3" id="pr3" value="75">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Medio">
                                                            <input type="radio" name="pr3" id="pr3" value="50">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Bajo">
                                                            <input type="radio" name="pr3" id="pr3" value="25">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy bajo">
                                                            <input type="radio" name="pr3" id="pr3" value="0">
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4. ¿El desempeño (preguntó sobre nuevas dudas del tema) del estudiante durante la tutoría fué?</td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy alto">
                                                            <input type="radio" name="pr4" id="pr4" value="100">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Alto">
                                                            <input type="radio" name="pr4" id="pr4" value="75">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Medio">
                                                            <input type="radio" name="pr4" id="pr4" value="50">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Bajo">
                                                            <input type="radio" name="pr4" id="pr4" value="25">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy bajo">
                                                            <input type="radio" name="pr4" id="pr4" value="0">
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5. En general ¿cómo califica la participación del estudiante durante la tutoría?</td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy alto">
                                                            <input type="radio" name="pr5" id="pr5" value="100">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Alto">
                                                            <input type="radio" name="pr5" id="pr5" value="75">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Medio">
                                                            <input type="radio" name="pr5" id="pr5"value="50">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Bajo">
                                                            <input type="radio" name="pr5" id="pr5" value="25">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="hint--bottom" data-hint="Muy bajo">
                                                            <input type="radio" name="pr5" id="pr5" value="0">
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark btn-block" name="asistencia" value="si" title="Evaluar y registrar asistencia del estudiante {{$user_estudiante->name}} {{$user_estudiante->lastname}}">Registrar evaluación <span class="fas fa-user-check"></span></button>
                                </form>
                            </div>
                        </div>
                    <br>
                </div>
                <div class="input-group mb-3" id="asistencia_no" style="display:none;">
                    <form action="{{url("evaluacion_estudiante/{$user_estudiante->id}/{$solitutoria_id}")}}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="asistencia" value="no" title="Evaluar y registrar inasistencia del estudiante {{$user_estudiante->name}} {{$user_estudiante->lastname}}">Enviar <span class="fas fa-user-times"></span></button>
                    </form>
                </div>
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