@extends('layout_estudiante')

@section('content')
    @include('user_student.vistas_iguales.menu_horizontal')
@endsection

@section('content2')
    <div class="row">
        @include('user_student.vistas_iguales.imagen_texto')
        <div class="col-9" id="titulo_general">
            <h3>Vista general - Estudiante</h3>
        </div>
    </div>
@endsection

@section('content3')
    <div class="row">
        <div class="col-12">
            @include('user_student.vistas_iguales.menu_vertical')
        </div>
    </div>
@endsection

@section('content4')
    @include('user_student.vistas_iguales.footer')
@endsection

@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection