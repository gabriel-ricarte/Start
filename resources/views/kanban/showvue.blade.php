@extends('layouts.dashboard')
@section('titulo')
KANBAN 
@endsection
@section('js')
<script type="text/javascript" src="{{asset('js/jquery-1.9.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jqueryui-certo.js')}}"></script>
<script type="text/javascript" src="{{asset('js/paineis3.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/noselect.css')}}">
@endsection
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/wobble.css')}}"> -->
@endsection
@section('projetoA','active')
@section('local',$kanban->nome)
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
			<div class="container-fluid" >
				<div class="container" style="margin-top: -18px;">
					<br>
					<span><b>AÇÕES</b></span><br>
					<div class="row" id="funcoes">

						<center>	
						<!-- controle de permissões -->
						@if($permi->permissao == 0)	
							<button title="Nova Tarefa" type="button" class="btn btn-info btn-outline btn-lg text-white" onclick="abreFuncao('novaTarefaDiv')">
								NOVA TAREFA	
							</button>
							<button title="Revisão de Tarefa" type="button" class="btn btn-secondary btn-outline btn-lg active" onclick="abreFuncao('revisaTarefaDiv')" >
								<i class="fas fa-tools"></i>
							</button>
							<button title="Finalizar Quadro" type="button" class="btn btn-secondary btn-outline btn-lg active" onclick="abreFuncao('finalizarQuadroDiv')" >
								<i class="fas fa-check-double"></i>
							</button>
						@endif	
						@if($quadros[1]['quadro'] > 0)
							<button title="Pausar Tarefa" type="button" class="btn btn-secondary active btn-outline btn-lg " onclick="abreFuncao('pausaTarefaDiv')" >
								<i class="fa fa-pause"></i>
							</button>
						@endif
						@if($permi->permissao == 0)	
							<button title="Excluir Tarefa" type="button" class="btn btn-danger btn-outline btn-lg " onclick="abreFuncao('excluiTarefaDiv')" >
								<i class="fas fa-trash-alt"></i>
							</button>
						@endif	
						</center>
						<div class="row" id="responseDiv" style="display: none">
							<span class="" id="responseHere" style="float: right"></span>	
						</div>
						<div class="row" id="formRevisao" style="display: none">
							
						</div>
					</div>
					@include('parciais.nova-tarefa')
					@include('parciais.revisa-tarefa')
					<style type="text/css">
.sticky{position:fixed;margin:0;width:30%;top:20%;left:55%;-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);z-index:1000}
					</style>
					<div class="row justify-content-center"  id="finalizarQuadroDiv" style="margin-bottom: 10px;display: none;">
						<div class="col-xl-6 col-md-6 mb-4  bg-light" >
							<div class="card  border-0 shadow-lg my-5 " >
								<div class="card-header bg-primary text-white ">FINALIZAR QUADRO ? <span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha('finalizarQuadroDiv')"  ><span  ><i class="fas fa-times-circle"></i></span></button></span></div>
								<div class="card-body text-center" style="min-height: 80px">
									<form method="post" action="{{ route('finalizar.quadro') }}" class="form-horizontal" id="formFinalizaQuadro" >
										@csrf
										<input type="hidden" name="kanban" value="{{$kanban->id}}">
										<button class="btn btn-success active">CONFIRMAR</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center"  id="revisaTarefaDiv" style="margin-bottom: 10px;display: none">
						<div class="col-xl-6 col-md-6 mb-4  bg-light" style="height: 150px" >
							<div class="card  border-0 shadow-lg my-5 sticky"  >
								<div class="card-header bg-primary text-white ">ARRASTE A TEREFA QUE DESEJA REVISAR<span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha('revisaTarefaDiv')" ><span   ><i class="fas fa-times-circle"></i></span></button></span></div>
								<div class="card-body text-center connectedSortable" id="revisaTarefaQuadro" style="min-height: 80px">
									
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center"  id="excluiTarefaDiv" style="margin-bottom: 10px;display: none">
						<div class="col-xl-6 col-md-6 mb-4 bg-light" style="height: 150px"  >
							<div class="card  border-0 shadow-lg my-5 sticky"  >
								<div class="card-header bg-primary text-white " >ARRASTE A TEREFA QUE DESEJA EXCLUIR<span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha('excluiTarefaDiv')" ><span   ><i class="fas fa-times-circle"></i></span></button></span></div>
								<div class="card-body text-center connectedSortable" id="excluiTarefaQuadro" style="min-height: 80px">
									
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center"  id="pausaTarefaDiv" style="margin-bottom: 10px;display: none">
						<div class="col-xl-6 col-md-6 mb-4  bg-light" style="height: 150px"  >
							<div class="card  border-0 shadow-lg my-5 sticky"  >
								<div class="card-header bg-primary text-white " >ARRASTE A TEREFA QUE DESEJA PAUSAR<span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha('pausaTarefaDiv')" ><span   ><i class="fas fa-times-circle"></i></span></button></span></div>
								<div class="card-body text-center connectedSortable" id="excluiTarefaQuadro" style="min-height: 80px">
									
								</div>
							</div>
						</div>
					</div>
				
				</div>
				<div class="row" id="app" >
					<quadro-um :tasks="tasks" :todo="{{$quadros[0]['quadro']}}" @primeiro="tasks = $event"></quadro-um>
					<quadro-dois :tasksdois="tasksdois" :doing="{{$quadros[1]['quadro']}}" @segundo="tasksdois = $event"></quadro-dois>
					<quadro-last :taskslast="taskslast" :done="{{$quadros[2]['quadro']}}" @last="taskslast = $event"></quadro-last>
				</div>
				<!-- <div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">

						</div>
					</div>
				</div> -->



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

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>
<style type="text/css">

	.dragg{
		cursor: move; 
		
	}
</style>
<script>
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});
	
	function reset(){
		
		document.getElementById('formNovaTarefa').innerHTML = `<center>
										<h3 style="font-family: 'VT323', monospace;">NOVA TAREFA</h3>
										<form method="get" action="{{ route('newtask') }}"  class="user" id="formTarefa">
											<div class="form-group">
												<input type="text" class="form-control" name="tarefa" id="tarefa" required="" placeholder="TAREFA AQUI" autocomplete="off">
												<input type="hidden" name="id" value="{{$kanban->id}}">

											</div>
											<div class="form-group">
												<label for="integrante">INTEGRANTE RESPONSÁVEL PELA TAREFA</label>
												<select type="text" class="form-control" id="integrante" required="" name="tecnico">
													<option selected="" hidden="" value="">ESCOLHA AQUI</option>
													@foreach($membros as $membro)
													<option value="{{$membro->user->id}}">{{$membro->user->nome}}</option>
													@endforeach
												</select>	 								
											</div>
											<center><button type="button" class="btn btn-success active" onclick="setTimeout(function() {executaFormNovaTarefa(); },250);" >CONFIRMAR</button></center>
										</form>
									</center>`;            
	}
</script>

<a hidden>
	<form method="get" action="{{ route('movetask') }}" class="form-horizontal" id="moveForm" >
		<div id="insert">

		</div>
	</form>
</a>

<a hidden>
	<form method="get" action="{{ route('deltask') }}" class="form-horizontal" id="lixoForm" >
		<div id="insertlixo">

		</div>
	</form>
</a>
<a hidden>
	<form method="get" action="{{ route('revisa.task') }}" class="form-horizontal" id="revisaForm" >
		<div id="insertRevisao">

		</div>
	</form>
</a>
<a hidden>
	<form method="get" action="{{ route('pausa.task') }}" class="form-horizontal" id="pausaForm" >
		<div id="insertPausa">

		</div>
	</form>
</a>
<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






