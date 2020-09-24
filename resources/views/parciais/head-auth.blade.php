<head>
	<title>BEM VINDO !</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Gabriel Ricarte da Silva">
    <meta name="description" content="O start é um sistema feito na nuvem para tornar possível o acompanhamento do projetos desenvolvidos pela TI do Sistema Jangadeiro ;D">
    <meta name="keywords" content="start,Sistema Jangadeiro,projetos,gerenciamento">
    <title>START  @yield('titulo')</title>
    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <!-- Fonts -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="icon" href="../../images/iconeee.png">
    <link rel="stylesheet" href="{{asset('css/material-icon.css')}}">
    <link href="{{asset('vendor/fontawesome-free/css/all.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 	<!-- Custom styles for this template-->
  	<link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/tabs.css')}}">
  	<!-- CSS das paginas  -->
  	@yield('css') 
  	<!-- JS das paginas -->
  	@yield('js') 
  	<link href="css/custom2.css" rel="stylesheet">
</head>
