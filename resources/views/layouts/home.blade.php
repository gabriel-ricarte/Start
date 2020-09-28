<!DOCTYPE html>
<html lang="pt-br">
@include('parciais.head')
<body id="page-top">
  <div id='app'></div>
@include('parciais.mensagens')
@yield('conteudo')

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Contact Form JavaScript -->
  <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
  <script src="{{asset('js/contact_me.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('js/freelancer.min.js')}}"></script>



</body>
</html>