@extends('layouts.dashboard')
@section('titulo')
Equipes
@endsection
@section('js')
<script src="{{asset('js/gerenciaEquipes.js')}}"></script>

@endsection
@section('equipeA','active')
@section('local','EQUIPES')
@section('conteudo')
@include('parciais.loading-page')
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
 <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    @include('dashboard.side-bar')
    <!-- End of Sidebar -->
<div id="app">  <input type="hidden"  id="todo"value="0">
        <input type="hidden"  id="doing"value="0">
        <input type="hidden"  id="done"value="0"></div>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       @include('dashboard.top-bar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-lg-7" id="desce" style="display: none">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" id="texto">Buscando dados ...</h6><span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha()"><span class="far fa-times-circle"></span></button></span>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="exibe">
                    <center><div class="loader"></div></center>
                </div>
              </div>
            </div>
          </div>
         <div class="row">

            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" id="and">TODOS OS PROJETOS</h6>
                  <h6 class="m-0 font-weight-bold text-primary" id="quad" style="display: none">TODOS OS INTEGRANTES</h6>
                  <h6 class="m-0 font-weight-bold btn btn-primary" id="btnV" style="display: none" onclick="sobe()" ><span class="fas fa-arrow-left"></span></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                 <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr id="projs">
                      <th>PROJETO</th>
                      <th>INTEGRANTES</th>
                      <th>STATUS</th>
                      <th>VER EQUIPE</th>
                    </tr>
                    <tr id="equips" style="display: none">
                      <th>INTEGRANTE</th>
                      <th>EMAIL</th>
                      <th>CONTATO</th>
                      <th>PERMISSÃO</th>
                      <th>AÇÕES</th>
                    </tr>
                  </thead>
                  <tbody id="sobe">
                  	@forelse($projetos as $projeto)
                    <tr>
                      <td>{{$projeto->nome}}</td>
                      <td>{{$projeto->equipe->first->equipeUser->ativos->count()}}</td>
                      <td>
                      	@if($projeto->status == 1)
                      	EM ANDAMENTO
                      	@else
                      	FINALIZADO
                      	@endif
                      </td>
                      <td>
                      	<button class="btn btn-danger" onclick="desce({{$projeto->id}})" ><span class="fas fa-eye"></span></button>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button class="btn btn-danger">into non existe !</button></td>
                      <td></td>
                      <td></td>
                    </tr>
                    @endforelse
                  </tbody>
                 	@forelse($projetos as $projeto)
                  	<tbody  id="desce{{$projeto->id}}" style="display: none">
                      
                  		@forelse($projeto->equipe as $equipe)
                  			@foreach($equipe->ativos as $tecnico)
                  				<tr>
                  					<td>{{$tecnico->user->nome}}</td>
                  					<td>{{$tecnico->user->email}}</td>
                  					<td>{{$tecnico->user->contato}}</td>
                  					<td>
                                @if($tecnico->permissao == 0)
                                <button class="btn btn-danger">TOTAL</button>
                                @else
                                <button class="btn btn-danger">PARCIAL</button>
                                @endif
                  					</td>
                            <input type="hidden" id="equipe{{$tecnico->user->id}}" value="{{$equipe->id}}">
                            <input type="hidden" id="nome{{$tecnico->user->id}}" value="{{$tecnico->user->nome}}">
                            <input type="hidden" id="email{{$tecnico->user->id}}" value="{{$tecnico->user->email}}">
                            <input type="hidden" id="tec{{$tecnico->user->id}}" value="{{$tecnico->user->id}}">
                  					<td>

                  						  <button class="btn btn-info" type="button" onclick="preparaEdicao('{{$equipe->id}}','{{$tecnico->user->id}}','{{$projeto->id}}','{{$tecnico->user->nome}}')"><span class="far fa-edit"></span></button> 
                              
                                <button class="btn btn-danger"  type="button" onclick="preparaEx('{{$equipe->id}}','{{$tecnico->user->id}}','{{$projeto->id}}')"><span class="fas fa-trash-alt"></span></button>
                             
									         </td>
                  				</tr>
                  			@endforeach	
                  		@empty
                  		@endforelse
                        <tr>
                          <td><center><a href="{{route('equipe.criando',$projeto->id)}}" style="text-decoration: none"><button class="btn btn-primary btn-block">ADICIONAR INTEGRANTE</button></a></center></td>
                        </tr>
                  	</tbody>
                  	@empty
                  	@endforelse
                 
                </table>
              </div>
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

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <a hidden>
    <form method="get" action="{{ route('alterplayer') }}" class="form-horizontal" id="upup" >
      <div id="insertUp">

      </div>
    </form>
  </a>



<div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="image-gallery-title" style="font-family: 'VT323', monospace;">ALTERANDO PERMISSÃO DO(A) INTEGRANTE - <span id="tecnomeU"></span></h3>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row" style="padding-bottom: 8px">
              <span>PERMISSÃO ATUAL : <span id="permissaoa"></span></span>
              
            </div>
            <input type="hidden" name="tecidUp" value="">
            <div class="row"  style="padding-bottom: 8px">  
              <select type="text" name="permissao" class="form-control" id="permisshion">
                <option value="" selected disabled hidden>ESCOLHA UMA PERMISSÃO</option>
                <option value="0">TOTAL - CRIAR E MOVER TAREFAS</option>
                <option value="1">PARCIAL - MOVER TAREFAS</option>
              </select>
            </div>
              <div >
                <center>
                  <button type="button" class="btn btn-success " data-dismiss="modal" onclick="permishon()" id="alter">OK</button>
                </center>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
      function preparaEx(equipe,user,proj){
      document.getElementById('exibe').innerHTML = '<center><div class="loader"></div></center>';
          document.getElementById('texto').innerHTML = 'Preparando Exclusão ...';
          $("#sobe").slideUp( "slow", function() {});
           
          $("#desce").slideDown( "slow", function() {});
        
         setTimeout(function() {

          document.getElementById('texto').innerHTML = '';
           document.getElementById('texto').innerHTML = 'Pronto para a Exclusão ! ';
          
          
        
          document.getElementById('exibe').innerHTML = '';
          document.getElementById('exibe').innerHTML = 
          `
           <form method="post" action="{{route('removeplayer')}}"  class="user" enctype="multipart/form-data">
                        @csrf
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <center>
                    <label for="cliente">O integrante escolhido vai ser retirado do projeto !</label>
                    
                    <input type="hidden" name="equipe_id" value="`+equipe+`" >
                    <input type="hidden" name="user_id" value="`+user+`" >
                    <input type="hidden" name="projeto_id" value="`+proj+`" >
                    <br>
                   <button class="btn btn-primary btn-md">EXCLUIR</button>
                   </center>
                  </div>

                </div>
              </form>
          `
          ;


          },2000);
          

}
 function preparaEdicao(equipe,user,proj,nome){
      document.getElementById('exibe').innerHTML = '<center><div class="loader"></div></center>';
          document.getElementById('texto').innerHTML = 'Preparando Edição ...';
          $("#sobe").slideUp( "slow", function() {});
           
          $("#desce").slideDown( "slow", function() {});
        
         setTimeout(function() {

          document.getElementById('texto').innerHTML = '';
          document.getElementById('texto').innerHTML = 'Pronto para a Edição ! ';
          document.getElementById('exibe').innerHTML = '';
          document.getElementById('exibe').innerHTML = 
          `
           <form method="post" action="{{route('alterplayer')}}"  class="user" enctype="multipart/form-data">
                        @csrf
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <center>
                     <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="prioridade">PERMISSÃO DE `+nome+`</label>
                    <select class="form-control" type="text" id="prioridade" name="permissao" required>
                      <option selected="" value="" hidden>Escolha uma prioridade</option>
                      <option value="0">TOTAL</option>
                      <option value="1">PARCIAL</option>
                      
                    </select>
                  </div>
                    
                    <input type="hidden" name="equipe_id" value="`+equipe+`" >
                    <input type="hidden" name="user_id" value="`+user+`" >
                    <input type="hidden" name="projeto_id" value="`+proj+`" >
                    <br>
                   <button class="btn btn-primary btn-md">CONFIRMAR</button>
                   </center>
                  </div>

                </div>
              </form>
          `
          ;


          },2000);
          

}
    function fecha(){
      //$("#sobe").slideDown( "slow", function() {});
      $("#desce").slideUp( "slow", function() {});
    }
// function excluir(t) {
//           document.getElementById('exibe').innerHTML = '<center><div class="loader"></div></center>';
//           document.getElementById('texto').innerHTML = 'Preparando Transferência ...';
//           $("#sobe").slideUp( "slow", function() {});
//            setTimeout(function() { executaTransfer(t); },2000);
//           $("#desce").slideDown( "slow", function() {});
        
//             }
</script>

  @include('parciais.modal-logout')
  @include('parciais.modal-oops')
@endsection






