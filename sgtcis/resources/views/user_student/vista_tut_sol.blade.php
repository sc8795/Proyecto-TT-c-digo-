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
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Por favor seleccione una opción para que pueda ver el registro de tutorías.</span></h4>
                <hr>
                <div id="mensaje_siete">
                    @include('flash::message')
                </div>
                @if($solitutorias->isNotEmpty() || $invitaciones->isNotEmpty())
                    @if ($solitutorias->isNotEmpty())
                        <div class="container text-center" id="cont_reg_t">
                            <a href="{{url("vista_tut_sol")}}" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio">Tutorías solicitadas</a>
                        </div>
                        <br>
                        @if ($invitaciones->isNotEmpty())
                            <div class="container text-center" id="cont_reg_t">
                                <a href="{{url("vista_tut_inv")}}" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio">Invitaciones a tutoría</a>
                            </div>
                            <br>
                        @else
                            <div class="container text-center" id="cont_reg_t">
                                <button type="button" class="btn btn-dark btn-block btn-sm" disabled="disabled" id="borde_radio" title="No tiene invitaciones a tutoría">Invitaciones a tutoría</button>
                            </div>
                            <br>
                        @endif
                    @else
                        <div class="container text-center" id="cont_reg_t">
                            <button type="button" class="btn btn-dark btn-block btn-sm" disabled="disabled" id="borde_radio" title="No tiene tutorías solicitadas">Tutorías solicitadas</button>
                        </div>
                        <br>
                        <div class="container text-center" id="cont_reg_t">
                            <a href="{{url("vista_tut_inv")}}" class="btn btn-outline-dark btn-block btn-sm" id="borde_radio">Invitaciones a tutoría</a>
                        </div>
                        <br>
                    @endif
                    <hr>
                    <a href="{{route('solicitar_tutoria')}}" class="btn btn-dark" id="borde_radio">Solicitar tutoría</a>
                    <br>
                    <br>
                @else
                    <h5 id="txt_opcion_menu_vertical"><span class="negrita">No tiene registro de tutorías</span></h5>
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