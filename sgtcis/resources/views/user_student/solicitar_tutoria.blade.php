@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Solicitar Tutoría</h3>
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
                @if($materias->isNotEmpty())
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="col-6">Nombre materia</th>
                            <th scope="col" class="col-3">Docente que la imparte</th>
                            <th scope="col" class="col-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @foreach ($materias as $materia)
                            <tr>
                                @if ($user->paralelo_a==$materia->paralelo_a&&$user->ciclo==$materia->ciclo&&$materia->ciclo=="Décimo")
                                    <td><h6 class="tit_general">{{$materia->name}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="tit_general">
                                            @foreach ($users_docentes as $user_docente)
                                                @if ($materia->usuario_id==$user_docente->id)
                                                    {{$user_docente->name}} {{$user_docente->lastname}}
                                                @endif
                                            @endforeach
                                        </h6>
                                    </td>
                                    <td><h6 class="tit_general"><a href="#">Solicitar tutoría</a></h6></td>
                                @endif
                            </tr>
                            @endforeach   
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h6 class="tit_general">No hay datos registradas</h6>
                @endif
            </div>
        </div>
    </div>
@endsection