@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Materias registradas</h3>
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
                @if($materias->isNotEmpty())
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Nombre materia</th>
                          <th scope="col">Ciclo</th>
                          <th scope="col">Docente</th>
                          <th scope="col">Paralelo</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($materias as $materia)
                            <tr>
                              <td><h6 class="tit_general">{{$materia->name}}</h6></td>
                              <td><h6 class="tit_general">{{$materia->ciclo}}</h6></td>
                              <td>
                                <h6 class="tit_general">
                                  @foreach ($users as $user)
                                      @if ($materia->usuario_id==$user->id)
                                          {{$user->name}} {{$user->lastname}}
                                      @endif
                                  @endforeach
                                </h6>
                              </td>
                              <td><h6 class="tit_general">{{$materia->paralelo}}</h6></td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                @else
                    <h6 class="tit_general">No hay usuarios materias registradas</h6>
                @endif
            </div>
        </div>
    </div>
@endsection