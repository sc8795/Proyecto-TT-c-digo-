@extends('layout_administrador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('user_administrador.vistas_iguales.menu_vertical')
            <div class="container-fluid" id="espacio_menu_texto"></div>
            <div class="container-fluid" style="background: white" id="txt_opcion_menu_vertical">
                <h1><span class="negrita">Registro de actividades realizadas en el sistema</span></h1>
                <div class="row">
                    @php
                        $login_estudiantes=DB::table('logs')->where('tipo',1)->where('tipo_usuario',2)->get();
                        $num_login_estudiantes=$login_estudiantes->count();
                        $login_docentes=DB::table('logs')->where('tipo',1)->where('tipo_usuario',3)->get();
                        $num_login_docentes=$login_docentes->count();
                        $estudiantes=DB::table('users')->where('is_estudiante',true)->get();
                        $num_est=$estudiantes->count();
                        $tutorias=DB::table('solitutorias')->get();
                        $num_tut=$tutorias->count();
                    @endphp
                    <div class="col-4" style="margin-left: 15px;">
                        <div class="row">
                            <div class="col-6">
                                <div class="row bg-info">
                                    <div class="col-2">
                                        <span class="fas fa-user text-white" style="margin-top: 20px;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span class="text-white" style="font-size: 35px;">{{$num_login_estudiantes}}</span>
                                    </div>
                                </div>
                                <div class="row border border-info" style="text-align: center">
                                    <div class="col-12 text-center">Estudiantes</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row bg-info">
                                    <div class="col-2">
                                        <span class="fas fa-user-tie text-white" style="margin-top: 20px;"></span>
                                    </div>
                                    <div class="col-10 text-right">
                                        <span class="text-white" style="font-size: 35px;">{{$num_login_docentes}}</span>
                                    </div>
                                </div>
                                <div class="row border border-info">
                                    <div class="col-12 text-center">Docentes</div>
                                </div>
                            </div>
                        </div>
                        <div class="row border border-success bg-success">
                            <div class="col-12 text-center">Inicios de sesión</div>
                        </div>
                    </div>
                </div> 
                <hr>
                <div class="container my-4">
                    <div class="row">
                          <!-- Grid column -->
                        <div class="col-xl-6 mb-4 mb-xl-0">
                        <!-- Title -->
                        <h2 class="secondary-heading mb-3">
                            Inicios de Sesión
                        </h2>
                        <!-- Description -->
                        <p class="mb-4">Registros de inicio de sesión al sistema</p>
                        <!-- Section: Live preview -->
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
                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <br>
                                    @if($login_estudiantes->isNotEmpty())
                                        <table class="table" id="dataTable3">
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
                                        </table>
                                        <br>
                                    @else
                                        <h6 class="tit_general">No existen registros</h6>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>
                                    @if($login_docentes->isNotEmpty())
                                        <table class="table" id="dataTable3">
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
                        <!-- Grid column -->
                    
                        <!-- Grid column -->
                        <div class="col-xl-6">
                    
                        <!-- Title -->
                        <h2 class="secondary-heading">
                            Material tabs
                        </h2>
                    
                        <!-- Description -->
                        <p class="mb-4">Material Design styling for Bootstrap Tabs component</p>
                    
                        <!-- Section: Live preview -->
                        <section class="mx-2 pb-3">
                    
                            <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md" aria-selected="false">Contact</a>
                            </li>
                            </ul>
                            <div class="tab-content card pt-5" id="myTabContentMD">
                            <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
                                <p>Lili 1</p>
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
            </div>
            <div class="container-fluid" id="espacio_menu_texto"></div>
            @include('user_administrador.vistas_iguales.footer')
            </div>
            </div>
        </div>
    </div>
@endsection