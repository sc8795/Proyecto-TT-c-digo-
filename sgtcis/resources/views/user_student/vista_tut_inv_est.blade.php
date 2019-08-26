@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_student")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Registro de tutorías</span>
                </h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Lista de tutorías que ha solicitado</span></h4>
                <hr>
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                @if($invitaciones->isNotEmpty())
                    <div class="col-lg-12" id="txt_opcion_menu_vertical">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Invitado por</th>
                                        <th>Docente</th>
                                        <th>Materia</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                    @foreach ($invitaciones as $invitacion)
                                        @php
                                            $estudiante=DB::table('users')->where('id',$invitacion->user_invita_id)->first();
                                            $solitutoria=DB::table('solitutorias')->where('id',$invitacion->solitutoria_id)->first();
                                            $docente=DB::table('users')->where('id',$solitutoria->docente_id)->first();
                                            $materia=DB::table('materias')->where('id',$solitutoria->materia_id)->first();
                                        @endphp
                                        <tr>                                        
                                            <td>{{$estudiante->name}} {{$estudiante->lastname}}</td>
                                            <td>{{$docente->name}} {{$docente->lastname}}</td>
                                            <td>{{$materia->name}}</td>
                                        </tr>
                                    @endforeach
                                </thead>
                            </table>
                            <hr>
                            <a href="{{route('solicitar_tutoria')}}" class="btn btn-dark" id="borde_radio">Solicitar nueva tutoría</a>
                            <hr>
                        </div>
                    </div>
                @else
                    <h5 id="txt_opcion_menu_vertical"><span class="negrita">No ha sido invitado a tutorías</span></h5>
                    <br>
                    <br>
                    <hr>
                    <a href="{{route('solicitar_tutoria')}}" class="btn btn-dark" id="borde_radio">Solicitar tutoría</a>
                    <br>
                    <br>
                @endif
                <!--form action="{{url("enviar_mail")}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit">Prueba de enviar email</button>
                </form-->
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