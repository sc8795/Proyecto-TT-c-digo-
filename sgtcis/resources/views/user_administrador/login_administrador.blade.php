@extends('layout_inicio_sesion')

@section('content')
<div class="col-4" id="form_admin">
    <!--Formulario para acceder al software como administrador-->
    <form method="POST" action="{{route('login_administrador')}}" id="txt_opcion_menu_vertical">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-1">
                <img src="{{asset('images/logo_unl.png')}}" style="width: 100px">
            </div>
            <div class="col-7"></div>
            <div class="col-4">
                <img src="{{asset('images/logo_cis.jpg')}}" style="width: 100px;">
            </div>
        </div>
        <div class="text-center">
            <hr>
            <h4>Bienvenido Administrador</h4>
            <hr>
        </div>
        <div class="centrar_img_usuario_logueo">
            <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
        </div>
        <!--presenta mensaje de error cuando el usuario que está por iniciar sesión 
        no es administrador-->
        @if (Auth::check())
          @php
              $user=Auth::user();
          @endphp
          @if ($user->is_admin!=true)
            <div class="alert alert-danger">
              Usted no es administrador. Por favor intente nuevamente.
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
        <!--solicita campos correo-->
        <div class="form-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope-square"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email - correo" value="{{old('email')}}">
            </div>
            @if ($errors->has('email'))
                <p>{{$errors->first('email')}}</p>
            @endif
        </div>
        <!--solicita campos password o contraseña-->
        <div class="form-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Contraseña">
            </div>
            @if ($errors->has('password'))
                <p>{{$errors->first('password')}}</p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
    </form>
</div>
@endsection    
