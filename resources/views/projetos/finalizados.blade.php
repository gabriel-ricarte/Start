@extends('layouts.dashboard')
@section('titulo')
PROJETOS FINALIZADOS
@endsection
@section('dashA','active')
@section('local','DASHBOARD')
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


          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Projetos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$projetos->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-project-diagram fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
<!--  -->

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tarefas Completas (Total)</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$tarefaC}}</div>
                        </div>
                        <!-- <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$ptarefa}}%" aria-valuenow="{{$ptarefa}}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="far fa-list-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" id="and">PROJETOS FINALIZADOS</h6>
                </div>

                <div class="card-body">
                	 <div class="row">
                	 	@foreach($projetos as $projeto)
						<div class="col-xl-3 col-md-6 mb-4">
						</div>
						@endforeach
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <!-- <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">INICIAR NOVA AVENTURA <span class="far fa-flag"></span></h6>
                </div>

                <div class="card-body">
                 <center><a href="{{route('projeto.create')}}" style="text-decoration: none"> <button class="btn btn-danger btn-lg">NOVO PROJETO</button></a></center>
                </div>
              </div>
            </div> -->
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
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<script type="text/javascript">
  function desce(id){
     $("#raus").slideUp( "fast", function() {$("#projeto"+id).slideDown( "fast", function() {});});
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






