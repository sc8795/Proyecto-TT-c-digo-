<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de evaluación al estudiante {{$estudiante->name}} {{$estudiante->lastname}}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    {!! Html::style('css/estilos_pdf.css') !!}
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="posicion_logo_unl">
                <img src="{{asset('images/logo_unl.png')}}" class="logo_unl">
            </div>
            <div class="posicion_titulo_unl">
                <h4 class="titulo_unl_facultad_carrera">Universidad Nacional de Loja</h4>
                <h5 class="titulo_unl_facultad_carrera">Facultad de la Energía las Industrias y los Recursos Naturales no Renovables</h5>
                <h6 class="titulo_unl_facultad_carrera">Carrera de Ingeniería en Sistemas</h6>
            </div>
            <div class="posicion_logo_cis">
                <img src="{{asset('images/logo_cis.jpg')}}" class="logo_cis">
            </div>    
        </div> 
        <div class="row">
            <div class="w3-container w3-right-align">
                <h6 class="titulo_reporte"> <hr> Reporte de tutoría {{$date}}</h6>
            </div> 
        </div>
        <div class="row">
            <div class="w3-container">
                <h6 class="titulo_reporte"> Docente: Ing. {{$docente->name}} {{$docente->lastname}}</h6>
            </div> 
        </div>   
        <br>
        <br>
        <!--div class="row"-->
            <div class="w3-container w3-small contenedor_datos_estudiante">
                <h6 class="titulo_estudiante">Datos estudiante evaluado</h6>
            </div>
        <!--/div-->
        <!--div class="row"-->
            <div class="w3-container w3-small w3-border contenedor_datos_estudiante_inf">
                <br>
                <h6 class="negrita">Nombre: <span class="quita_negrita">{{$estudiante->name}} {{$estudiante->lastname}}</span>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <span class="negrita">Ciclo: <span class="quita_negrita">{{$estudiante->ciclo}}</span></span>
                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <span class="negrita">Paralelo: <span class="quita_negrita">{{$estudiante->paralelo}}</span></span>
                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <span class="negrita">Asistencia: <span class="quita_negrita">{{$evaluacion->asistencia}}</span></span>
                </h6>
            </div>
        <!--/div-->

        <br><br>
        <!--div class="row"-->
        <div class="w3-container w3-small contenedor_datos_estudiante">
                <h6 class="titulo_estudiante">Datos tutoría evaluada</h6>
            </div>
        <!--/div-->
        <!--div class="row"-->
            <div class="w3-container w3-small w3-border contenedor_datos_estudiante_inf">
                <br>
                <h6 class="negrita">Tema de tutoría: <span class="quita_negrita">{{$evaluacion->tema}}</span></h6>
                <h6 class="negrita">Descripcion de tutoría: <span class="quita_negrita">{{$evaluacion->descripcion}}</span></h6>
                @php
                    $fecha_solicita=$solitutoria->fecha_solicita;
                    $date = date_create($fecha_solicita);
                    $fecha_solicita=date_format($date, 'd-m-Y');
                    $fecha_confirma=$solitutoria->fecha_confirma;
                    $date = date_create($fecha_confirma);
                    $fecha_confirma=date_format($date, 'd-m-Y');
                    $fecha_tutoria=$solitutoria->fecha_tutoria;
                    $date = date_create($fecha_tutoria);
                    $fecha_tutoria=date_format($date, 'd-m-Y');
                @endphp
                <h6 class="negrita">Fecha solicitada: <span class="quita_negrita">{{$fecha_solicita}}</span>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <span class="negrita">Fecha confirmada: <span class="quita_negrita">{{$fecha_confirma}}</span></span>
                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <span class="negrita">Fecha impartida: <span class="quita_negrita">{{$fecha_tutoria}}</span></span>
                </h6>
                <h6 class="negrita">Modalidad: <span class="quita_negrita">{{$solitutoria->modalidad}}</span>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <span class="negrita">Tipo: <span class="quita_negrita">{{$solitutoria->tipo}}</span></span>
                </h6>
                @if ($solitutoria->modalidad=="virtual")
                    <h6 class="negrita">Medio virtual: <span class="quita_negrita">{{$solitutoria->medio_virtual}}</span>

                    </h6>
                @endif
                <h6 class="negrita">Calificación del estudiante: <span class="quita_negrita">{{$evaluacion->evaluacion}}%</span></h6>
                <div class="w3-container">
                    @if ($evaluacion->evaluacion>=70)
                        <div class="w3-light-grey">
                            <div class="w3-container w3-green w3-center" style="width:{{$evaluacion->evaluacion}}%">{{$evaluacion->evaluacion}}%</div>
                        </div><br>
                    @endif
                    @if ($evaluacion->evaluacion<70)
                        <div class="w3-light-grey">
                            <div class="w3-container w3-red w3-center" style="width:{{$evaluacion->evaluacion}}%">{{$evaluacion->evaluacion}}%</div>
                        </div><br>
                    @endif                    
                </div>
            </div>
        <!--/div-->
    </div>
</body>
</html>