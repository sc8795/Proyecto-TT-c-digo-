<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css" integrity="sha256-CNwnGWPO03a1kOlAsGaH5g8P3dFaqFqqGFV/1nkX5OU=" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos_docente.css')}}">
	<link rel="stylesheet" href="{{asset('css/estilos_pag_inicio.css')}}">
	<link rel="stylesheet" href="{{asset('css/hint.min.css')}}">

	<!--Para el calendario-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<title>@yield('title')Docente - SGTCIS</title>
</head>
<body>
	<div class="container-fluid">
		<!--Se agrega yield('content') para el menu horizontal-->
		@yield('content')
	</div>
	<div class="container-fluid">
		<!--Se agrega yield('content') para la imagen y titulo del menu vertical-->
		@yield('content2')
	</div>
	<div class="container-fluid">
		<!--Se agrega yield('content') para el menu vertical-->
		@yield('content3')
	</div>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery_docente.js')}}"></script>

<!--Para el calendario-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>