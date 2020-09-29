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
                <div class="card-body" id="invi" style="display: none">
                  <div class="row" id="pesquisei">
                    
                  </div>
                </div>	
                <div class="card-body" id="projj">
                  @if($projetos != null)
                  <div class="row" id="raus">
                    @foreach($projetos as $projeto)
                    <div class="col-xl-3 col-md-6 mb-4">
                      <div class="card-header text-center btn-primary text-uppercase" onclick="desce({{$projeto['projeto_id']}},'{{$projeto['projeto_nome']}}')">
                        {{$projeto['projeto_nome']}}
                      </div>
                      <div class="card">
                        <div class="progress" >
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$projeto['percentagem']}}%" aria-valuenow="{{$projeto['percentagem']}}" aria-valuemin="0" aria-valuemax="100">{{$projeto['percentagem']}}%</div>
                        </div>

                      </div>
                    </div>
                    @endforeach
                  </div>
                  @else
                  <h2>Sem projetos iniciados </h2>
                  @endif

                  <!-- timeline -->
                  @if($projetos != null)
                    @foreach($projetos as $projeto)
                    <div class="row" id="projeto{{$projeto['projeto_id']}}" style="display: none">
                       
                          @foreach($projeto['kanban'] as $kanban)
                          <div class="col-xs-4 col-sm-6 col-md-4">
                               <div class="image-flip" >
                                        <div class="mainflip flip-0">
                                            <div class="frontside">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <p><img class=" img-fluid" src="../../images/{{$projeto['imagem']}}" alt="card image"></p>
                                                        <h4 class="card-title">{{$kanban['kanban_nome']}}</h4>
                                                        <p class="card-text">{{$kanban['descricao']}}.</p>
                                                        <div class="progress" >
                                                        	<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:{{$kanban['percentagem']}}%" aria-valuenow="{{$kanban['percentagem']}}" aria-valuemin="0" aria-valuemax="100">{{$kanban['percentagem']}}%</div>
                                                        </div>
                                                        @if($kanban['status'] == 2)
                                                        	<br>
                                                        	<span class="btn btn-primary active text-center">QUADRO FINALIZADO</span>
                                                        @else
                                                        <br>
                                                        	<span class="btn btn-warning active text-center">QUADRO EM ANDAMENTO</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="backside">
                                                <div class="card">
                                                    <div class="card-body text-center mt-4">
                                                        <h4 class="card-title">{{$kanban['kanban_nome']}}</h4>
                                                        @if($kanban['status'] == 2)
                                                        <p class="card-text">Quadro teve início em {{$kanban['data_ini']}}, previsto para término em {{$kanban['data_fim']}}, foi concluído em {{$kanban['concluido']}}.</p>
                                                        @else
                                                        <p class="card-text">Quadro teve início em {{$kanban['data_ini']}}, previsto para término em {{$kanban['data_fim']}}, ainda está em andamento.</p>
                                                        @endif
                                                         @if($kanban['status'] == 2)
                                                        	  	@if($kanban['dif'] >= 0)
		                                                            <span class="list-inline-item alert alert-primary">
		                                                               Entregue com <b>{{$kanban['dif']}}</b>  restantes
		                                                            </span>
                                                            	@else
		                                                            <span class="list-inline-item alert alert-primary">
		                                                               Entregue com <b>{{$kanban['dif']}}</b> 
		                                                            </span>
                                                            	@endif	
                                                         @else 
                                                         <span class="list-inline-item alert alert-primary">
		                                                            <b>{{$kanban['dif']}}</b> restantes
		                                                 </span>  	
                                                         @endif
                                                        <ul class="list-inline">
                                                        	
                                                            <li class="list-inline-item">
                                                                Pendências <b>{{$kanban['tarefas_pendentes']}}</b>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                Tasks Realizadas <b>{{$kanban['tarefas_completas']}}</b>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                
                                                            </li>
                                                        </ul>
                                                        
                                                         <button class="btn btn-info active" onclick="pesquisaQuadro({{$kanban['kanban_id']}} ,{{$projeto['projeto_id']}})"><span class=" text-center">VER</span></button>
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
<a hidden>
  @php
  $rota =  substr(route('busca.quadro',1),0,-1);
  
  @endphp
</a>
<p>

</p>


  <!-- Page level custom scripts -->

  <!-- Scroll to Top Button-->
  <a hidden>
	  <form method="get" action="#" class="form-horizontal" id="cinza" >
	              <div id="inserir">

	              </div>
	  </form>
	</a>
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
     $("#pesquisei").slideUp( "fast", function() {});
     $("#quad").slideUp( "fast", function() {$("#and").slideDown( "fast", function() {});$("#btnV").slideUp( "fast", function() {});});
  }
  function pesquisaQuadro(data , id){
    $('#cinza').attr('action',`{{$rota}}`+data);
  	$("#projeto"+id).slideUp( "slow", function() { });
    setTimeout(function() { $("#invi").slideDown( "slow", function() { })},100);
    document.getElementById('invi').innerHTML = 
    `
    <center><div class="loader"></div></center>
    `
    ;
    document.getElementById('inserir').innerHTML = 
    `
    <input type="text" name="dado"  class="form-control col-12" value="`+data+`" required>
    
    `
    setTimeout(function() { executa(); },100); 
}
  function executa(){
  var form = $('#cinza');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  var show =  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function() {
      
      //alert('certo');
      },
      error: function(){
        //alert('errado');
      }
    });
  	console.log(show);
	show.done(function(dat){ 
	 document.getElementById('invi').innerHTML = 
    `
     <div class="row" id="pesquisei">
                    
                  </div>
    `
    ;
   if(Object.values(dat).length == 0) {

    }else{

    	console.log(dat);
		document.getElementById('pesquisei').innerHTML = "";
			for (var i = 0; i < Object.values(dat).length; i++) {

       
			   let hora =  `
        <div class="col-xl-3 col-md-6 mb-4 `+Object.values(dat)[i].prioridade+`"> 
          <div class="card-body" >
              <h5 class="text-center noselect">`+  
                        Object.values(dat)[i].task
                   +`</h5>
              <small class=" bottom-right noselect" style="float: right">`+  
                        Object.values(dat)[i].dono
                   +`</small>
            </div>
          </div>

        `;
			                $('#pesquisei').append(hora);
			}
	}



   });

}
</script>
  <!-- Logout Modal-->
@include('parciais.modal-logout')
@include('parciais.modal-oops')
@endsection






