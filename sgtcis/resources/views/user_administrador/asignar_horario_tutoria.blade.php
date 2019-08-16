@extends('layout_docente')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical"><span class="negrita">Vista general de la cuenta</span></h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Perfil</span></h4>
                <br>
                <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <form class="card" method="GET" action="{{url("asignar_horario_tutoria")}}">
                                <div class="row no-gutters align-items-center">
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-borderless form-control-sm" name="name" type="search" placeholder="Nombres">
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-borderless form-control-sm" name="lastname" type="search" placeholder="Apellidos">
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-borderless form-control-sm" name="email" type="search" placeholder="Email">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-success btn-sm" type="submit" title="Buscar docente por nombre, apellido o email">Buscar <i class="fas fa-search">&nbsp;</i></button>
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
                          </tbody>
                        </table>
                        {{$users->render()}}
                    @else
                        <h6 class="tit_general">No existe docente registrado, con los datos ingresados</h6>
                    @endif
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection