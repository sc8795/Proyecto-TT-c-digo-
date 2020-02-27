<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css" integrity="sha256-CNwnGWPO03a1kOlAsGaH5g8P3dFaqFqqGFV/1nkX5OU=" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos_administrador.css')}}">
	<link rel="stylesheet" href="{{asset('css/estilos_pag_inicio.css')}}">
	<link rel="stylesheet" href="{{asset('css/estilos_estudiante.css')}}">
	<link rel="stylesheet" href="{{asset('css/estilos_docente.css')}}">
	<link rel="stylesheet" href="{{asset('css/hint.min.css')}}">
	<link rel="stylesheet" href="{{asset('alertifyjs/css/alertify.css')}}">
	<link rel="stylesheet" href="{{asset('alertifyjs/css/themes/default.css')}}">
	
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
	
	<!--Para el calendario-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<title>@yield('title')SGTCIS</title>
</head>
<body>
		
	@yield('content')
	@yield('content2')
	@yield('content3')
	@yield('content4')
	
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('alertifyjs/alertify.js')}}"></script>
<script src="{{asset('js/jquery_administrador.js')}}"></script>
<script src="{{asset('js/jquery_estudiante.js')}}"></script>
<script src="{{asset('js/jquery_docente.js')}}"></script>

@yield('scripts')

</body>
</html>