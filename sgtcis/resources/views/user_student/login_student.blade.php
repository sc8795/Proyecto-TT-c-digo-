@extends('layout_inicio_sesion')
@section('content')
  <div class="row">
    <div class="col-4" id="form_admin">
      <form method="POST" action="{{route('login_student')}}">
        {{ csrf_field() }}
        <div class="centrar_img_usuario_logueo">
            <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
        </div>
        <!--presenta mensaje de error cuando el usuario que está por iniciar sesión 
        no es estudiante-->
        @if (Auth::check())
          @php
              $user=Auth::user();
          @endphp
          @if ($user->is_estudiante!=true)
            <div class="alert alert-danger">
              Usted no es estudiante. Por favor intente nuevamente.
              @php
                Auth::logout();
              @endphp 
            </div>
          @endif
        @endif
        <!--mensaje de error cuando el correo o contraseña es incorrecto-->
        <div id="mensaje_siete">
            @include('flash::message')
        </div>
        <!--solicita campo correo-->
        <div class="form-group">
          <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
          @if ($errors->has('email'))
            <p>{{$errors->first('email')}}</p>
          @endif
        </div>
        <!--solicita campo password o contraseña-->
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Contraseña">
          @if ($errors->has('password'))
            <p>{{$errors->first('password')}}</p>
          @endif
        </div>
        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        <br>
        <!--botón para iniciar sesión con google-->
        <div class="form-group">
          <a href="{{ url('student/auth/google') }}" class="btn btn-google btn-danger btn-block"><i class="fab fa-google"></i> Iniciar Sesión con Google</a>
        </div>
      </form>
      <hr>
      <h6 class="texto_volver"><a href="{{url('/')}}"><i class="fas fa-arrow-left"></i> Volver a inicio</a></h6>
    </div>
  </div>
@endsection