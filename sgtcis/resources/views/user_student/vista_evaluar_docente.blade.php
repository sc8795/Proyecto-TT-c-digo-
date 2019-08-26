@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Evaluación al docente</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Preguntas</span></h4>
                <br>
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>

                <form action="{{url("evaluacion_docente/{$docente->id}/{$solitutoria_id}/{$notification}")}}" method="POST" onsubmit="return validar_evaluacion_docente()">
                    {{ csrf_field() }}
                    <div class="container" id=""> 
                        <br>
                        Por favor conteste las siguientes preguntas:
                        <hr>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Preguntas</th>
                                    <th scope="col">5</th>
                                    <th scope="col">4</th>
                                    <th scope="col">3</th>
                                    <th scope="col">2</th>
                                    <th scope="col">1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1. ¿El docente fué puntual al atender la tutoría?</td>
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
                                <tr>
                                    <td>2. ¿El docente generó un clima propicio de comunicación?</td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Totalmente de acuerdo">
                                            <input type="radio" name="pr2" id="pr2" value="100">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="De acuerdo">
                                            <input type="radio" name="pr2" id="pr2" value="75">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Indeciso">
                                            <input type="radio" name="pr2" id="pr2" value="50">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="En desacuerdo">
                                            <input type="radio" name="pr2" id="pr2" value="25">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Totalmente en desacuerdo">
                                            <input type="radio" name="pr2" id="pr2" value="0"> 
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3. ¿El docente brindó la orientación oportuna para atender sus dificultades académicas?</td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Totalmente de acuerdo">
                                            <input type="radio" name="pr3" id="pr3" value="100">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="De acuerdo">
                                            <input type="radio" name="pr3" id="pr3" value="75">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Indeciso">
                                            <input type="radio" name="pr3" id="pr3" value="50">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="En desacuerdo">
                                            <input type="radio" name="pr3" id="pr3" value="25">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Totalmente en desacuerdo">
                                            <input type="radio" name="pr3" id="pr3" value="0"> 
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4. ¿El docente proporcionó documentación de apoyo (libros, documentos, sitios web) para atender sus dificultades académicas?</td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Totalmente de acuerdo">
                                            <input type="radio" name="pr4" id="pr4" value="100">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="De acuerdo">
                                            <input type="radio" name="pr4" id="pr4" value="75">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Indeciso">
                                            <input type="radio" name="pr4" id="pr4" value="50">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="En desacuerdo">
                                            <input type="radio" name="pr4" id="pr4" value="25">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="Totalmente en desacuerdo">
                                            <input type="radio" name="pr4" id="pr4" value="0"> 
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5. En general ¿cómo califica al docente con respecto a la tutoría recibida?</td>
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
                                            <input type="radio" name="pr5" id="pr5" value="50">
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
                        <hr>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-block" title="Evaluar al docente {{$docente->name}} {{$docente->lastname}}">Enviar <span class="fas fa-user-check"></span></button>
                </form>
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