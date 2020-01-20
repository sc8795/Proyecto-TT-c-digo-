<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <!--librerías para los iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflae.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css" integrity="sha256-CNwnGWPO03a1kOlAsGaH5g8P3dFaqFqqGFV/1nkX5OU=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--llamado a boostrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--llamado a los estilos de la página de inicio-->
    <link rel="stylesheet" href="css/estilos_pag_inicio.css">
    <!-- Fuente de letra -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <!--titulo del proyecto, aparecerá en todas las vistas que llamen a esta vista-->
    <title>@yield('title')SGTCIS</title>
</head>
<body>
    <!--para los contenidos en las vistas-->
    @yield('header')
    @yield('footer')
<!--llamado a jquery-->        
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery_inicio.js')}}"></script>
<!--para llamar a librerias o archivos js en las vistas-->
@yield('scripts')
</body>
</html>
