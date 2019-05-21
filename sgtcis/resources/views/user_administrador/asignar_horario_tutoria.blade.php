@extends('layout_administrador')

@section('content')
    @include('user_administrador.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_administrador.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Seleccione docente para asignar horario de tutoría</h3>
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
                <div class="row">
                    <div class="col-3">
                        <h6 class="tit_general">Buscar docente por: </h6>
                    </div>
                    <div class="col-9">
                        <form class="card" method="GET" action="{{url("asignar_horario_tutoria")}}">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-search">&nbsp;</i>
                                </div>
                                <!--end of col-->
                                <div class="col">
                                    <input class="form-control form-control-borderless" name="name" type="search" placeholder="Nombres">
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-borderless" name="lastname" type="search" placeholder="Apellidos">
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-borderless" name="email" type="search" placeholder="Email">
                                </div>
                                <!--end of col-->
                                <div class="col-auto">
                                    <button class="btn btn-success" type="submit">Buscar</button>
                                </div>
                                <!--end of col-->
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                @if($users->isNotEmpty())
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Nombres y Apellidos</th>
                          <th scope="col">Correo</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($users as $user)
                            <tr>
                                <td><h6 class="tit_general">{{$user->id}}</h6></td>
                                <td><h6 class="tit_general">{{$user->name}} {{$user->lastname}}</h6></td>
                                <td><h6 class="tit_general">{{$user->email}}</h6></td>
                                <td>
                                <form method="POST" action="{{url("asignar_horario_docente/{$user->id}")}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-link" id="tit_general_op2"><span class="fas fa-clock"></span> Asignar horario</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        {{$users->render()}}
                      </tbody>
                    </table>
                    {{$users->render()}}
                @else
                    <h6 class="tit_general">No existe docente registrado, con los datos ingresados</h6>
                @endif
            </div>    
        </div>
    </div>
@endsection