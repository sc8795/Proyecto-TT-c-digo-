@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista general - Estudiante</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_student.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div id="mensaje">
                @include('flash::message')
            </div>
            <div class="container" id="contenedor_general">
                <form action="{{route('editar_perfil_student')}}">
                    <h5 class="tit_general">Usuario:</h5>
                    <h6 class="tit_datos">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{auth()->user()->name}} {{auth()->user()->lastname}}</h6>
                    <hr>
                    <h5 class="tit_general">Correo electrónico:</h5>
                    <h6 class="tit_datos">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{auth()->user()->email}}</h6>
                    <hr>
                    <button type="submit" class="btn btn-dark">Editar perfil</button>
                </form>
            </div>
        </div>  
    </div>
@endsection
 