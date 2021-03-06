@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container-fluid" style="background: white" id="txt_opcion_menu_vertical">
                <h1><span class="negrita">Registro de actividades realizadas en el sistema</span></h1>
                <hr>
                <div class="row">
                    <!--TUTORÍAS-->
                    <div class="col-7" style="margin-left: 15px;">
                        <div class="row">
                            <div class="col-4 border-right border-white" id="fondoLogTutoria">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="fas fa-paper-plane" style="margin-top: 20px; color:#f7dc6f;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span style="font-size: 35px; color:#f7dc6f;">{{$tutorias_solicitadas->count()}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center" style="color: white">Solicitadas</div>
                                </div>
                            </div>
                            <div class="col-4 border-right border-white" id="fondoLogTutoria">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="fas fa-check-circle" style="margin-top: 20px; color:#a2d9ce"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span style="font-size: 35px;color:#a2d9ce">{{$login_docentes->count()}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center" style="color: white">Confirmadas</div>
                                </div>
                            </div>
                            <div class="col-4" id="fondoLogTutoria">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="fas fa-times-circle" style="margin-top: 20px;color:#f1948a;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span style="font-size: 35px;color:#f1948a;">{{$login_docentes->count()}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center" style="color: white">Rechazadas</div>
                                </div>
                            </div>
                        </div>
                        <div class="row border" id="fondoLogTutoria">
                            <div class="col-12 text-center" style="color: white"><span class="negrita">Tutorías</span></div>
                        </div>
                    </div>
                    <!--INICIOS DE SESIÓN-->
                    <div class="col-4" style="margin-left: 15px;">
                        <div class="row">
                            <div class="col-6" id="fondoLogInicioSesion">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="fas fa-user" style="margin-top: 20px;color: white;"></span>
                                    </div>
                                    <div class="col-10 text-right border-right border-white">
                                        <span style="font-size: 35px;color: white;">{{$login_estudiantes->count()}}</span>
                                    </div>
                                </div>
                                <div class="row border-right border-white">
                                    <div class="col-12 text-center">Estudiantes</div>
                                </div>
                            </div>
                            <div class="col-6" id="fondoLogInicioSesion">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="fas fa-user-tie" style="margin-top: 20px;color: white;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span style="font-size: 35px;color: white;">{{$login_docentes->count()}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">Docentes</div>
                                </div>
                            </div>
                        </div>
                        <div class="row border" id="fondoLogInicioSesion">
                            <div class="col-12 text-center"><span class="negrita">Inicios de sesión</span></div>
                        </div>
                    </div>
                </div> <br>
                <div class="row">
                    <!--NOTIFICACIONES-->
                    <div class="col-7" style="margin-left: 15px;">
                        <div class="row">
                            <div class="col-4 border-right border-white" id="fondoLogNotificacion">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="fas fa-user" style="margin-top: 20px;color:#d9d0cd;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span style="font-size: 35px;color:#d9d0cd;">{{$notificaciones_estudiantes->count()}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center" style="color: white">Estudiantes</div>
                                </div>
                            </div>
                            <div class="col-4 border-right border-white" id="fondoLogNotificacion">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="fas fa-user-tie" style="margin-top: 20px;color:#d9d0cd;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span style="font-size: 35px;color:#d9d0cd;">{{$notificaciones_docentes->count()}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center" style="color: white">Docentes</div>
                                </div>
                            </div>
                            <div class="col-4" id="fondoLogNotificacion">
                                <div class="row">
                                    <div class="col-2">
                                        <span class="far fa-id-card" style="margin-top: 20px;color:#d9d0cd;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span style="font-size: 35px;color:#d9d0cd;">{{$invitaciones_estudiantes->count()}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center" style="color: white">Invitaciones</div>
                                </div>
                            </div>
                        </div>
                        <div class="row border" id="fondoLogNotificacion">
                            <div class="col-12 text-center" style="color: white">
                                <span class="fas fa-bell"></span>
                                <span class="negrita">Notificaciones</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container my-4">
                    <div class="row">
                        <div class="col-xl-6 mb-4 mb-xl-0">
                        <h2 class="secondary-heading mb-3">
                            Inicios de Sesión
                        </h2>
                        <p class="mb-4">Registros de inicio de sesión al sistema</p>
                        <section>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Estudiantes</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Docentes</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
                                    @if($login_estudiantes->isNotEmpty())
                                        <table class="table" id="dataTable2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($login_estudiantes as $log)
                                                    @php
                                                        $fecha=$log->fecha;
                                                        $date = date_create($fecha);
                                                        $fecha=date_format($date, 'd-m-Y');
                                                        $hora=date_format($date, 'G:ia');
                                                    @endphp
                                                    <tr>
                                                        <td>{{$log->detalle}}</td>
                                                        <td>{{$fecha}}</td>
                                                        <td>{{$hora}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table><br>
                                    @else
                                        <h6 class="tit_general">No existen registros</h6>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>
                                    @if($login_docentes->isNotEmpty())
                                        <table class="table" id="dataTable2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($login_docentes as $log)
                                                    @php
                                                        $fecha=$log->fecha;
                                                        $date = date_create($fecha);
                                                        $fecha=date_format($date, 'd-m-Y');
                                                        $hora=date_format($date, 'G:ia');
                                                    @endphp
                                                    <tr>
                                                        <td>{{$log->detalle}}</td>
                                                        <td>{{$fecha}}</td>
                                                        <td>{{$hora}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                    @else
                                        <h6>No existen registros</h6>
                                    @endif
                                </div>
                            </div>
                        </section>
                        <!-- Section: Live preview -->
                    </div>
                    <div class="col-xl-6">
                        <h2 class="secondary-heading">
                            Tutorías
                        </h2>
                        <p class="mb-4">Registro de tutorías en el sistema</p>
                        <section class="mx-2 pb-3">
                            <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md" aria-selected="true">Solicitadas</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md" aria-selected="false">Confirmadas</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md" aria-selected="false">Rechazadas</a>
                                </li>
                            </ul>
                            <div class="tab-content card pt-4" id="myTabContentMD">
                            <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
                                @if($tutorias_solicitadas->isNotEmpty())
                                    <table class="table" id="dataTableTutorias">
                                        <thead>
                                            <tr>
                                                <th scope="col">Detalle</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tutorias_solicitadas as $log)
                                                @php
                                                    $fecha=$log->fecha;
                                                    $date = date_create($fecha);
                                                    $fecha=date_format($date, 'd-m-Y');
                                                    $hora=date_format($date, 'G:ia');
                                                @endphp
                                                <tr>
                                                    <td>{{$log->detalle}}</td>
                                                    <td>{{$fecha}}</td>
                                                    <td>{{$hora}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                @else
                                    <h6 class="tit_general">No existen registros</h6>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
                                <p>Lili 2</p>
                            </div>
                            <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
                                <p>Lili 3</p>
                            </div>
                            </div>
                    
                        </section>
                        <!-- Section: Live preview -->
                    
                        </div>
                        <!-- Grid column -->
                    </div>
                </div>
                <div class="container my-4">
                    <div class="row">
                          <!-- Grid column -->
                        <div class="col-xl-6 mb-4 mb-xl-0">
                        <!-- Title -->
                        <h2 class="secondary-heading mb-3">
                            Notificaciones
                        </h2>
                        <!-- Description -->
                        <p class="mb-4">Registros de notificaciones en el sistema</p>
                        <!-- Section: Live preview -->
                        <section>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" id="notificaciones_estudiantes-tab" data-toggle="tab" href="#noti_estudiantes" role="tab" aria-controls="noti_estudiantes" aria-selected="false">Estudiantes</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" id="notificaciones_docentes-tab" data-toggle="tab" href="#noti_docentes" role="tab" aria-controls="noti_docentes" aria-selected="false">Docentes</a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" id="invitations-tab" data-toggle="tab" href="#invitations" role="tab" aria-controls="invitations" aria-selected="false">Invitaciones</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="noti_estudiantes" role="tabpanel" aria-labelledby="notificaciones_estudiantes-tab">
                                    <br>
                                    @if($notificaciones_estudiantes->isNotEmpty())
                                        <table class="table" id="dataTableNotificaciones">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notificaciones_estudiantes as $log)
                                                    @php
                                                        $fecha=$log->fecha;
                                                        $date = date_create($fecha);
                                                        $fecha=date_format($date, 'd-m-Y');
                                                        $hora=date_format($date, 'G:ia');
                                                    @endphp
                                                    <tr>
                                                        <td>{{$log->detalle}}</td>
                                                        <td>{{$fecha}}</td>
                                                        <td>{{$hora}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                    @else
                                        <h6 class="tit_general">No existen registros</h6>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="noti_docentes" role="tabpanel" aria-labelledby="notificaciones_docentes-tab">
                                    <br>
                                    @if($notificaciones_docentes->isNotEmpty())
                                        <table class="table" id="dataTable2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notificaciones_docentes as $log)
                                                    @php
                                                        $fecha=$log->fecha;
                                                        $date = date_create($fecha);
                                                        $fecha=date_format($date, 'd-m-Y');
                                                        $hora=date_format($date, 'G:ia');
                                                    @endphp
                                                    <tr>
                                                        <td>{{$log->detalle}}</td>
                                                        <td>{{$fecha}}</td>
                                                        <td>{{$hora}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                    @else
                                        <h6>No existen registros</h6>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="invitations" role="tabpanel" aria-labelledby="invitations-tab">
                                    <br>
                                    @if($invitaciones_estudiantes->isNotEmpty())
                                        <table class="table" id="dataTableNotificaciones">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($invitaciones_estudiantes as $log)
                                                    @php
                                                        $fecha=$log->fecha;
                                                        $date = date_create($fecha);
                                                        $fecha=date_format($date, 'd-m-Y');
                                                        $hora=date_format($date, 'G:ia');
                                                    @endphp
                                                    <tr>
                                                        <td>{{$log->detalle}}</td>
                                                        <td>{{$fecha}}</td>
                                                        <td>{{$hora}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                    @else
                                        <h6>No existen registros</h6>
                                    @endif
                                </div>
                            </div>
                        </section>
                        <!-- Section: Live preview -->
                    </div>
                    <div class="col-xl-6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection