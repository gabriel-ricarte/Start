<!DOCTYPE html>
<html lang="pt-BR">
@include('parciais.head-auth')

<body style="background-image: linear-gradient(#2c3e50, #D8D8D8);">
@include('parciais.mensagens')	
@include('parciais.navbar-auth')	
  <div class="container">
  	@yield('conteudo')

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
</body>

</html>
