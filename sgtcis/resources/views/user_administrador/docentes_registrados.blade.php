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
                    <div class="col-10" id="txt_opcion_menu_vertical">
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
                                  <td><h6>{{$user->name}} {{$user->lastname}}</h6></td>
                                  <td><h6>{{$user->email}}</h6></td>
                                  <td>
                                    <a href="{{url("editar_perfil_docente/{$user->id}")}}" class="hint--top hint--success btn btn-outline-success" data-hint="Editar">
                                      <span class="oi oi-pencil"></span>
                                    </a>
                                    <button type="button" class="hint--top hint--error btn btn-outline-danger" data-hint="Eliminar" data-toggle="modal" data-target="#confirmaEliminacion">
                                      <span class="oi oi-trash"></span>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmaEliminacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <span>¿Está seguro que desea eliminar docente?</span>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                            <form method="POST" action="{{url("eliminar_docente/{$user->id}")}}">
                                              {{csrf_field()}}
                                              {{method_field('DELETE')}}
                                              <button type="submit" class="btn btn-primary">SI</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <br>
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