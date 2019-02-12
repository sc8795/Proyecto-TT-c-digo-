@extends('layout_inicio_sesion')

@section('content')
<div class="col-4" id="form_admin">
        <!--Creamos la ruta login_administrador en web.php con el metodo post-->
    <form method="POST" action="{{route('login_docente')}}">
        {{ csrf_field() }}
        <div class="centrar_img_usuario_logueo">
            <img src="{{asset('images/usuario_logueo.png')}}" class="img_usuario_logueo">
        </div>
        <!--preguntamos si la variable errors tiene algun error para el campo email si lo tiene se imprime la clase has-error y si no lo tiene no se imprime nada-->
        <div class="form-group {{ $errors->has('email') ? 'alert alert-danger' :'' }}">
        <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
            <!--obtenemos el primer error del campo usuario y si existe alguno que lo imprima dentro de un span con el mensaje-->
            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->has('password') ? 'alert alert-danger' : '' }}">
            <input type="password" class="form-control" name="password" placeholder="Contraseña">
            <!--obtenemos el primer error del campo password y si existe alguno que lo imprima dentro de un span con el mensaje-->
            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
        </div>
        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
    </form>
</div>

@endsection    
