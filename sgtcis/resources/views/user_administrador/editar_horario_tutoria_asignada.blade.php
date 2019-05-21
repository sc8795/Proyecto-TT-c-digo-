@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Editar horario de tutoría asignado</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-3">
            @include('user_administrador.vistas_iguales.menu_vertical')
        </div>
        <div class="col-9">
            <div class="container" id="contenedor_general">
                <h6 class="tit_general">Docente: 
                    <span class="tit_datos"> {{$user->name}} {{$user->lastname}}</span>
                </h6>
                <form action="#" method="POST">
                    {{method_field("PUT")}}
                    {{ csrf_field() }}
                    <h6 class="tit_general">Día: 
                        <span class="tit_datos">
                            @if ($aux==1)
                                <input type="hidden" name="dia" value="{{$horarios->dia1_op3}}">{{$horarios->dia1_op3}}
                            @else
                                
                            @endif
                        </span>
                    </h6>
                    
                </form>
            </div>
        </div>
    </div>
@endsection