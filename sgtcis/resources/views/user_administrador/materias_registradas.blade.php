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
              <div id="mensaje">
                @include('flash::message')
              </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <form class="card" method="GET" action="{{url("buscar_materia")}}">
                            <div class="row no-gutters align-items-center">
                                <!--end of col-->
                                <div class="col">
                                    <input class="form-control form-control-borderless form-control-sm" name="name" type="search" placeholder="Nombre" title="Escriba el nombre de la materia">
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-borderless form-control-sm" name="ciclo" type="search" placeholder="Ciclo" title="Escriba el ciclo en que se imparte la materia (p. ej. Primero)">
                                </div>
                                
                                <!--end of col-->
                                <div class="col-auto">
                                    <button class="btn btn-success btn-sm" type="submit" title="Buscar materia por nombre o ciclo">Buscar <span class="fas fa-search"></span></button>
                                </div>
                                <!--end of col-->
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                @if($materias->isNotEmpty())
                  <table class="table">
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
                            <td>
                              <h6 class="tit_general">
                                {{$materia->paralelo}} 
                              </h6>
                            </td>
                            <td>
                                <form method="POST" action="{{url("eliminar_materia/{$materia->id}")}}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <a href="{{url("editar_materia/{$materia->id}")}}" class="btn btn-link" title="Editar materia"><span class="oi oi-pencil"></span></a>
                                    <a href="{{url("registrar_materia")}}" class="btn btn-link"><span class="fas fa-plus"></span></a>
                                    <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{$materias->render()}}
                @else
                  @if ($aux==0)
                    <h6 class="tit_general">No hay materias registradas</h6>  
                  @else
                    <h6 class="tit_general">No existen materias, con los datos ingresados</h6>  
                  @endif
                @endif
            </div>
        </div>
    </div>
@endsection