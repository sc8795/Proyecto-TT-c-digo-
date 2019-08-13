@extends('layout_estudiante')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container" style="background: white">
                <h1 id="txt_opcion_menu_vertical">
                    <a href="{{url("vista_general_student")}}" title="Regresar a vista general de la cuenta"><span class="fas fa-arrow-circle-left"></span></a>
                    <span class="negrita">Solicitar tutoría</span>
                </h1>
                <br>
                <h4 id="txt_opcion_menu_vertical"><span class="negrita">Materias que recibes actualmente</span></h4>
                <br>
                @if($arrastre->isNotEmpty())
                    <table class="table table-responsive table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="col-6">Nombre materia</th>
                                <th class="col-3">Docente que la imparte</th>
                                <th class="col-3">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $accion="v_p";  
                            @endphp
                            @foreach ($arrastre as $arras)
                                @php
                                    $arreglo_materia=explode('.', $arras->materia);
                                    $arreglo_docente=explode('.', $arras->docente);
                                @endphp
                                @for ($i=0; $i < count($arreglo_materia); $i++)
                                    @php
                                        $materia=DB::table('materias')->where('id',$arreglo_materia[$i])->first();
                                        $user_docente=DB::table('users')->where('id',$arreglo_docente[$i])->first();
                                    @endphp
                                    <tr>
                                        <td>{{$materia->name}}</td>
                                        <td>{{$user_docente->name}} {{$user_docente->lastname}}</td>
                                        <td>
                                            <form action="{{url("vista_solicitar_tutoria")}}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="accion" value="{{$accion}}">
                                                <input type="hidden" name="id_docente" value="{{$user_docente->id}}">
                                                <input type="hidden" name="id_materia" value="{{$materia->id}}">
                                                <button type="submit" class="btn btn-outline-dark btn-sm" id="borde_radio" title="Ir a formulario - solicitar tutoría">Solicitar tutoría <span class="fas fa-check-circle"></span></button>    
                                            </form>
                                        </td>
                                    </tr>
                                @endfor
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                @else
                    <h6 id="txt_opcion_menu_vertical"><span class="negrita">No hay materias registradas</span></h6>
                @endif
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