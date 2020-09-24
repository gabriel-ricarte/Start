<!DOCTYPE html>
<html lang="pt-br">
@include('parciais.head-dash')

<body id="page-top">
@include('parciais.mensagens')	
@yield('conteudo')

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/canvas2image@1.0.5/canvas2image.min.js"></script>

</body>
</html>