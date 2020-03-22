@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_admin")}}" title="Vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Docentes registrados</span>
                </h1>
                <!--Para presentar mensajes-->
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                <hr>
                <div class="container">
                  <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                      @if($users->isNotEmpty())
                        <table class="table" id="dataTable">
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
                                        <a href="{{url("editar_perfil_docente/{$user->id}")}}" class="btn btn-link">
                                          <span class="oi oi-pencil"></span>
                                        </a>
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
                    <div class="col-1"></div>
                  </div>
                </div>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_student.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection