@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Docentes registrados</h3>
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
                @if($users->isNotEmpty())
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Nombres y Apellidos</th>
                          <th scope="col">Correo</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($users as $user)
                            <tr>
                              <td><h6 class="tit_general">{{$user->name}} {{$user->lastname}}</h6></td>
                              <td><h6 class="tit_general">{{$user->email}}</h6></td>
                              <td>
                                <form method="POST" action="{{url("eliminar_docente/{$user->id}")}}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <a href="{{url("editar_perfil_docente/{$user->id}")}}" class="btn btn-link"><span class="oi oi-pencil"></span></a>
                                    <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                                </form>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                @else
                    <h6 class="tit_general">No hay usuarios registrados</h6>
                @endif
            </div>
        </div>
    </div>
@endsection