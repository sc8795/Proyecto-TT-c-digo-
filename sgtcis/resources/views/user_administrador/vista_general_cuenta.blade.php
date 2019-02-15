@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista general de la cuenta</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        @include('user_administrador.vistas_iguales.menu_vertical')
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <form action="{{route('editar_perfil_admin')}}">
                        <h4>Perfil</h4>
                        <br>
                        <h6 class="tit_general">Usuario:</h6>
                        <h6 class="tit_datos">&nbsp; &nbsp; &nbsp;{{ auth()->user()->name }}&nbsp; {{ auth()->user()->lastname }}</h6>
                        <hr>
                        <h6 class="tit_general">Email:</h6>
                        <h6 class="tit_datos">&nbsp; &nbsp; &nbsp;{{ auth()->user()->email }}</h6>
                        <hr>
                        <button type="submit" class="btn btn-dark">Editar perfil</button>
                </form>
            </div>
        </div>  
    </div>
@endsection
 