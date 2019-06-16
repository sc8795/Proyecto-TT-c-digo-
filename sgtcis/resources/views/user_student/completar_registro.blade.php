@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            {!! Alert::render() !!}
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            <div class="alert alert-dark">Menú de opciones no disponible hasta que complete el proceso de registro. 
                <br><br>
                <a href="#" class="btn btn-success btn-sm" title="Completar registro" id="completar">Completar registro <span class="fas fa-tasks"></span></a>
                <a href="#" class="btn btn-dark btn-sm" title="Acceder al menú de opciones, si ya ha completado su registro.">Omitir </a>
            </div>
        </div>
        <div class="col-9">            
            <div class="container" id="contenedor_general" style="display:none">
                <form action="">
                    <div class="d-flex p-2 bd-highlight" id="contenedor_2">
                        <span class="tit_datos">Completar registro</span>
                    </div>
                    <div class="container" id="contenedor_general_op2">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
