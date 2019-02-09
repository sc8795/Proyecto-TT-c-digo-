@extends('layout_inicio_sesion')

@section('content')
    <h1>Bienvenido</h1>
    <form method="POST" action="{{route('logout_administrador')}}">
        {{ csrf_field() }}
        <button class="btn btn-danger">Cerrar Sesion</button>
    </form>
@endsection