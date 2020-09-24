@extends('layouts.dashboard')
@section('titulo')
PROJETOS EM ANDAMENTO
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/flip.css')}}">
@endsection
@section('projetosA','active')
@section('local','PROJETOS EM ANDAMENTO')
@section('conteudo')
@include('parciais.loading-page')
 <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('dashboard.side-bar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       @include('dashboard.top-bar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
            {{-- aqui era os card de info --}}

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" id="and">SEUS PROJETOS EM ANDAMENTO</h6>
                  <h6 class="m-0 font-weight-bold text-primary" id="quad" style="display: none"></h6>
                  <h6 class="m-0 font-weight-bold btn btn-primary" id="btnV" style="display: none" onclick="sobe()" ><span class="fas fa-arrow-left"></span></h6>
                </div>

                <div class="card-body">
                  @if($andamento->count() > 0 )
                  <div class="row" id="raus">
                    @foreach($andamento as $proj)
                    <div class="col-xl-3 col-md-6 mb-4">
                      <div class="card-header text-center btn-primary text-uppercase" onclick="desce({{$proj->id}},'{{$proj->nome}}')">
                        {{$proj->nome}}
                      </div>
                      <div class="card">
                        <div class="progress" >
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$ptarefa}}%" aria-valuenow="{{$ptarefa}}" aria-valuemin="0" aria-valuemax="100">{{$ptarefa}}%</div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @else
                  <h2>Sem projetos iniciados </h2>
                  @endif

                  <!-- timeline -->
                  @if($andamento->count() > 0 )
                    @foreach($andamento as $proj)
                    <div class="row" id="projeto{{$proj->id}}" style="display: none">
                       
                          @foreach($proj->kanban as $kanban)
                          <div class="col-xs-4 col-sm-6 col-md-4">
                               <div class="image-flip" >
                                        <div class="mainflip flip-0">
                                            <div class="frontside">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <p><img class=" img-fluid" src="../../images/{{$proj->imagem}}" alt="card image"></p>
                                                        <h4 class="card-title">{{$kanban->nome}}</h4>
                                                        <p class="card-text">{{$kanban->descricao}}.</p>
                                                        <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="backside">
                                                <div class="card">
                                                    <div class="card-body text-center mt-4">
                                                        <h4 class="card-title">{{$kanban->nome}}</h4>
                                                        <p class="card-text">This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.</p>
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                                    <i class="fa fa-facebook"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                                    <i class="fa fa-twitter"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                                    <i class="fa fa-skype"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                                    <i class="fa fa-google"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                          @endforeach
                      
                    </div>
                    @endforeach
                  @endif


                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /.container-fluid -->

      </div>

      <!-- End of Main Content -->

     <!-- Footer -->
      @include('parciais.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
    <div id="app">  <input type="hidden"  id="todo"value="0">
        <input type="hidden"  id="doing"value="0">
        <input type="hidden"  id="done"value="0"></div>
  </div>
  <!-- End of Page Wrapper -->
  <!-- Page level plugins -->
  {{-- <script src="vendor/chart.js/Chart.min.js"></script> --}}

<p>

</p>


  <!-- Page level custom scripts -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<script type="text/javascript">
  function desce(id , nome){
     $("#raus").slideUp( "fast", function() {$("#projeto"+id).slideDown( "fast", function() {});});
     document.getElementById('quad').innerHTML = '';
     document.getElementById('quad').innerHTML = 'QUADROS DO PROJETO '+nome;
     $("#and").slideUp( "fast", function() {$("#quad").slideDown( "fast", function() {});$("#btnV").slideDown( "fast", function() {});});
     $("#btnV").attr('onclick','sobe('+id+')');
  }
  function sobe(id){
     $("#projeto"+id).slideUp( "fast", function() {$("#raus").slideDown( "fast", function() {});});
     $("#quad").slideUp( "fast", function() {$("#and").slideDown( "fast", function() {});$("#btnV").slideUp( "fast", function() {});});
  }
  function desce2(id){
     $("#raus2").slideUp( "fast", function() {$("#projetoo"+id).slideDown( "fast", function() {});});
     $("#and2").slideUp( "fast", function() {$("#quad2").slideDown( "fast", function() {});$("#btnV2").slideDown( "fast", function() {});});
     $("#btnV2").attr('onclick','sobe2('+id+')');
  }
  function sobe2(id){
     $("#projetoo"+id).slideUp( "fast", function() {$("#raus2").slideDown( "fast", function() {});});
     $("#quad2").slideUp( "fast", function() {$("#and2").slideDown( "fast", function() {});$("#btnV2").slideUp( "fast", function() {});});
  }
</script>
  <!-- Logout Modal-->
@include('parciais.modal-logout')
@include('parciais.modal-oops')
@endsection






