@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white" id="txt_opcion_menu_vertical">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_admin")}}" title="Vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Materias registradas</span>
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
                      @if($materias->isNotEmpty())
                        <table class="table" id="dataTable">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col" class="col-4">Nombre materia</th>
                              <th scope="col" class="col-1">Ciclo</th>
                              <th scope="col" class="col-3">Docente</th>
                              <th scope="col" class="col-1">Paralelos</th>
                              <th scope="col" class="col-2">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($materias as $materia)
                                <tr>
                                  <td><h6>{{$materia->name}}</h6></td>
                                  <td><h6>{{$materia->ciclo}}</h6></td>
                                  <td>
                                    <h6>
                                      @php
                                          $cont=0;$cont_aux=0;
                                      @endphp
                                      @foreach ($users as $user)
                                          @if ($materia->usuario_id==$user->id)
                                              {{$user->name}} {{$user->lastname}}
                                              @php
                                                  $cont=1;$cont_aux=1;
                                              @endphp
                                          @else
                                            @php
                                              $cont=2;
                                            @endphp
                                          @endif
                                      @endforeach
                                      @if ($cont_aux==0 && $cont==2 )
                                          <span style="color:red">No tiene asignado</span>
                                      @endif
                                    </h6>
                                  </td>
                                  <td style="text-align: center">
                                    <h6>
                                      {{$materia->paralelo}} 
                                    </h6>
                                  </td>
                                  <td style="text-align: center">
                                    <a href="{{url("editar_materia/{$materia->id}")}}" class="hint--top hint--success btn btn-success btn-sm" data-hint="Editar">
                                      <span class="oi oi-pencil"></span>
                                    </a>
                                    <button type="button" class="hint--top hint--error btn btn-danger btn-sm" data-hint="Eliminar" data-toggle="modal" data-target="#confirmaEliminacionMateria_{{ ($materia->id) }}">
                                      <span class="oi oi-trash"></span>
                                    </button>
                                    <a href="{{url("registrar_materia_diferente_docente")}}" class="hint--top hint--info btn btn-info btn-sm" data-hint="Registrar materia con diferente docente">
                                      <span class="fas fa-plus-circle"></span>
                                    </a>
                                    <!-- Modal confirmación eliminación materia-->
                                    <div class="modal fade" id="confirmaEliminacionMateria_{{ ($materia->id) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body" style="text-align: left">
                                            <span>¿Está seguro que desea eliminar la materia <span class="negrita">{{$materia->name}}</span> ?</span>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                            <form method="POST" action="{{url("eliminar_materia/{$materia->id}")}}">
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
                        @if ($aux==0)
                          <h6 class="tit_general">No hay materias registradas</h6>
                          <a href="{{url("registrar_materia")}}" class="btn btn-info btn-sm" title="Registrar materia"><span class="fas fa-plus-circle"></span> Registrar</a>
                        @else
                          <h6 class="tit_general">No existen materias, con los datos ingresados</h6>  
                        @endif
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