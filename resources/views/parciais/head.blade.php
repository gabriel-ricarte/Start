
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Gabriel Ricarte da Silva">
    <meta name="description" content="O start é um sistema feito na nuvem para tornar possível o acompanhamento do projetos desenvolvidos pela TI do Sistema Jangadeiro ;D">
    <meta name="keywords" content="start,Sistema Jangadeiro,projetos,gerenciamento">
    <title>START  @yield('titulo')</title>

    <!-- Styles -->
    <link rel="icon" href="../../images/iconeee.png">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!--     <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
  	<link href="{{ asset('css/freelancer.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    @yield('css')  

    @yield('js')
    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=VT323&display=swap" rel="stylesheet">

</head>
