@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_admin")}}" title="Vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Asignar horario de tutoría</span>
                </h1>
                <hr>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Busque y seleccione docente</span></h4>
                <br>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6" id="txt_opcion_menu_vertical">
                        @if($users->isNotEmpty())
                        <table class="table" id="dataTable2">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Nombres y Apellidos</th>
                              <th scope="col">Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><h6 class="tit_general">{{$user->name}} {{$user->lastname}}</h6></td>
                                    <td>
                                    <form method="POST" action="{{url("asignar_horario_docente/{$user->id}")}}">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio"><span class="fas fa-clock"></span> Asignar horario</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <br>
                    @else
                        <h6 class="tit_general">No existe docente registrado, con los datos ingresados</h6>
                    @endif
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection