@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Solicitar tutoría</h3>
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
                <h6 class="tit_general">Acción: 
                    <span class="tit_datos">Solicitar tutoría para la materia {{$materia->name}} con el docente {{$user_docente->name}} {{$user_docente->lastname}}.</span>
                </h6><br>
                <h6 class="tit_datos_op2">Llene los campos a continuación, para completar el proceso de solicitud de tutoría:</h6><br>
                <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                    <span class="tit_datos">Horario de tutoría</span>
                </div>
                <div class="container" id="contenedor_general_op2">
                    <br>
                    <h6>
                        <span class="negrita"> ¡Seleccione el día que desea la tutoría!</span>
                        El docente {{$user_docente->name}} {{$user_docente->lastname}} tiene asignado los siguientes horarios de tutoría:
                    </h6>
                    <form action="#">
                        <div class="row">
                            
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm" title="Solicitar tutoría" name="dia" value="3">Eliminar 
                            <span class="oi oi-trash">hhh</span><h6>
                                asaas
                            </h6>
                        </button>
                    </form>
                    <br>
                </div>

                <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                    <span class="tit_datos">Motivo de tutoría</span>
                </div>
                <div class="container" id="contenedor_general_op2">
                    <br>
                    <h6>
                        <span class="negrita"> ¡Motivo!</span>
                    </h6>
                    <br>
                </div>
            </div>        
        </div>
    </div>
@endsection