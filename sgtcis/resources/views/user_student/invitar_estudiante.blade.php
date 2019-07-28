@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Invitar estudiante</h3>
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
                <div id="mensaje">
                    @include('flash::message')
                </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <form class="card" method="GET" action="{{url("buscar_estudiante")}}">
                            <div class="row no-gutters align-items-center">
                                <!--end of col-->
                                <div class="col">
                                    <input class="form-control form-control-borderless form-control-sm" name="name" type="search" placeholder="Nombre" title="Escriba el nombre de la materia">
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-borderless form-control-sm" name="lastname" type="search" placeholder="Apellido" title="Escriba el ciclo en que se imparte la materia (p. ej. Primero)">
                                </div>
                                <!--end of col-->
                                <div class="col-auto">
                                    <button class="btn btn-success btn-sm" type="submit" title="Buscar estudiante">Buscar <span class="fas fa-search"></span></button>
                                </div>
                                <!--end of col-->
                            </div>
                        </form>
                    </div>
                </div>  
                @if ($estado==1)
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col" class="col">Nombres</th>
                            <th scope="col" class="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lista_estudiantes_sin_arrastre as $materia)
                                <tr>
                                    <td><h6 class="tit_general">{{$materia->name}} {{$materia->lastname}}</h6></td>
                                    <td><a href="#">Enviar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$lista_estudiantes_sin_arrastre->render()}}
                @endif
            </div>
        </div>
    </div>
@endsection