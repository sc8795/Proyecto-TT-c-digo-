<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div id="fondo_img_menu_vertical">
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="centrar_img_menu_vertical" id="fondo_img_menu_vertical">
          <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
      </div>
      <div class="list-group list-group-flush">
          <div class="vertical-menu">
              <ul class="menu_vertical">
                  <li>
                      <a href="{{url("vista_general_student")}}"><i class="icono izquierda far fa-eye"></i>Vista general de la cuenta</a>
                  </li>
                  <li>
                      <a href="{{route('solicitar_tutoria')}}"><i class="icono izquierda fas fa-chalkboard-teacher"></i>Solicitar tutoría</a>
                  </li>
                  <li>
                      @if (Auth::check())
                          <!--li class="nav-item dropdown"-->
                              <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-bell"></i> Notificaciones
                                  @if (auth()->user()->unreadNotifications->count()!=0)
                                    <span class="badge badge-danger" id="count-notification">{{auth()->user()->unreadNotifications->count()}}</span>
                                  @endif
                                  <span class="caret"></span>
                              </a>
                              <ul>
                                  <li>
                                  <!--div class="droptdown-menu" aria-labelledby="navbarDropdown"-->
                                      @if (auth()->user()->unreadNotifications->count())
                                          @foreach (auth()->user()->unreadNotifications as $notifications)
                                              @php
                                                  $arreglo=$notifications->data;
                                                  $title1 = data_get($arreglo, 'invita_estudiante.title');
                                                  $valida_invita_estudiante=starts_with($title1, 'Invitación');
                                                  
                                                  $title2 = data_get($arreglo, 'noti_estudiante.title');
                                                  $valida_noti_estudiante=str_contains($title2, 'Tutoría');
                                                  
                                              @endphp
                                          
                                              @if ($valida_noti_estudiante==true)
                                                  <a href="{{url("ver_tutoria_confirmada/{$notifications->data['noti_estudiante']['user_id']}/{$notifications->data['noti_estudiante']['user_estudiante_id']}/{$notifications->id}/{$notifications->data['noti_estudiante']['solitutoria_id']}")}}" class="droptdown-item">
                                                      <span class="fas fa-check-circle"></span>
                                                      {{$notifications->data['noti_estudiante']['descripcion']}} <br>
                                                      <span class="titulo_fecha_tutoria">{{$notifications->data['noti_estudiante']['created_at']}}</span>
                                                  </a>    
                                              @endif
                                              @if ($valida_invita_estudiante==true)
                                                  @php
                                                      $solitutoria=DB::table('solitutorias')->where('id',$notifications->data['invita_estudiante']['solitutoria_id'])->first();
                                                  @endphp
                                      
                                                  <input type="hidden" name="fecha_solicita" id="fecha_solicita" value="{{$solitutoria->fecha_solicita}}">
                                                  <input type="hidden" name="fecha_tutoria" id="fecha_tutoria" value="{{$solitutoria->fecha_tutoria}}">
                                                  
                                                  <a href="{{url("invitacion/{$notifications->data['invita_estudiante']['user_invita_id']}/{$notifications->data['invita_estudiante']['user_invitado_id']}/{$notifications->data['invita_estudiante']['solitutoria_id']}/{$notifications->id}")}}" class="droptdown-item" onclick="valida_confirmacion_docente();">
                                                      <span class="fas fa-envelope"></span>
                                                      {{$notifications->data['invita_estudiante']['descripcion']}} <br>
                                                      <span class="titulo_fecha_tutoria">{{$notifications->data['invita_estudiante']['created_at']}}</span>
                                                  </a>  
                                              @endif
                                          @endforeach   
                                      @endif
                                  <!--/div-->
                                  </li>
                              </ul>
                          <!--/li-->
                      @endif
                  </li>
                  <li class="logout_student">
                    <form method="POST" action="{{route('logout_student')}}" id="logout">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-light btn-block btn-sm">Cerrar sesión <span class="fas fa-sign-out-alt"></span></button>
                    </form>
                  </li>
              </ul>
          </div>
      </div>
    </div>
  </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="menu">
                <button class="btn btn-outline-primary btn-sm" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
            </div>
    
            <div class="nombre_menu">
                @if (Auth::check())
                    {{auth()->user()->name}} {{auth()->user()->lastname}}
                @endif
            </div>            
      </nav>
  <!-- /#wrapper -->

@section('scripts')
    <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
@endsection
  <!-- Menu Toggle Script -->
  