@extends('layout_inicio_sesion')

@section('content')
    <h1>Bienvenido Docente</h1>
    <form method="POST" action="{{route('logout_docente')}}">
        {{ csrf_field() }}
        <button class="btn btn-danger">Cerrar Sesion</button>
    </form>
@endsection