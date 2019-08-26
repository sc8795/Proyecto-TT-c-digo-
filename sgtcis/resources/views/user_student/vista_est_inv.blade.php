@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_student")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Estudiantes invitados</span>
                </h1>
                <br>
                <h4 id="txt_opcion_menu_vertical">
                    <span class="negrita">Invitar</span>
                    <a href="{{route('vista_tut_sol_est')}}" class="btn btn-outline-dark" id="borde_radio" title="Regresar a vista tutorías solicitadas">Cancelar</a>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
                        <!--CONDICIÓN QUE MUESTRA LA LISTA DE LOS ESTUDIANTES INVITADOS-->
                        @if ($invitacion!=null)
                            <div class="d-flex p-1 bd-highlight" id="fondo_tabla_general">
                                <span class="tit_datos">Lista estudiantes invitados</span>
                            </div>
                            <div class="container">
                                @php
                                    $arreglo_est_inv=explode('.',$invitacion->user_invitado_id);
                                    $arreglo_confirmacion=explode('.',$invitacion->confirmacion);
                                @endphp
                                @if ($arreglo_est_inv!=null)
                                    <table class="table table-bordered table-sm" id="txt_opcion_menu_vertical">
                                        <hr>
                                        <div id="mensaje_siete">
                                            @include('flash::message')
                                        </div>
                                        <thead>
                                            <tr>
                                                <th scope="col">Estudiante</th>
                                                <th scope="col">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($arreglo_est_inv); $i++)
                                                @php
                                                    $estudiante=DB::table('users')->where('id',$arreglo_est_inv[$i])->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                                    <td>
                                                        @if ($arreglo_confirmacion[$i]=="si")
                                                            <h6 style="background-color: #81c784" id="borde_radio" class="text-center">Unido/a</h6>
                                                        @else
                                                            <h6 style="background-color: #f78181" id="borde_radio" class="text-center">Por confirmar</h6>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                @else
                                <hr>
                                    <div id="mensaje_siete">
                                        @include('flash::message')
                                    </div>
                                    No ha invitado estudiantes
                                @endif
                            </div>
                        @else
                        <div id="mensaje_siete">
                            @include('flash::message')
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-12">
                        <!--FORMULARIO PARA BUSCAR ESTUDIANTE-->
                        <p id="txt_opcion_menu_vertical">Busca e invita a más compañeros</p>
                        <form class="card" method="POST" action="{{url("buscar_est#tipo_grupal")}}">
                            {{ csrf_field() }}
                            @if ($invitacion!=null)
                                <input type="hidden" name="solitutoria_id" value="{{$invitacion->solitutoria_id}}">
                            @endif
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <input class="form-control form-control-borderless form-control-sm" name="name" id="name" type="search" placeholder="Nombre" title="Escriba un nombre para buscar">
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-borderless form-control-sm" name="lastname" id="lastname" type="search" placeholder="Apellido" title="Escriba un apellido para buscar">
                                </div>
                                <div class="col-auto" id="txt_opcion_menu_vertical">
                                    <button class="btn btn-outline-success btn-sm" type="submit" title="Buscar estudiante">Buscar <span class="fas fa-search"></span></button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        @if ($lista_estudiantes_sin_arrastre->isNotEmpty())
                            <div id="mensaje_cuatro">
                                {!! Alert::render() !!}
                            </div>
                            <table class="table table-bordered table-sm" id="txt_opcion_menu_vertical">
                                <thead>
                                    <tr>
                                    <th class="col">Nombres</th>
                                    <th class="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lista_estudiantes_sin_arrastre as $estudiante)
                                        <form action="{{url("reg_est_inv_desp#tipo_grupal")}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_invitado_id" value="{{$estudiante->id}}">
                                            @if ($invitacion!=null)
                                                <input type="hidden" name="invitacion_id" value="{{$invitacion->id}}">
                                                <input type="hidden" name="solitutoria_id" value="{{$invitacion->solitutoria_id}}">
                                            @endif
                                            <tr>
                                                <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                                <td><button type="submit" class="hint--top btn btn-block btn-outline-warning btn-sm" data-hint="Invitar" name="modalidad" id="borde_radio" value="modalidad"><span class="fas fa-check-circle"></span></button></td>
                                            </tr>
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <span id="color_rojo">No se han encontrado resultados</span> 
                        @endif
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

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection