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
					<div class="row" id="sobe">
					<center>	
					@if($permi->permissao == 0)	
						<button type="button" class="btn btn-info btn-outline btn-lg text-white" onclick="anima()">
							NOVA TAREFA	
						</button>
						<!-- <button title="EDITE O PROJETO" type="button" class="btn btn-secondary btn-outline " style="margin-right: 8px" ><i class="far fa-edit"></i></button> -->
						<button title="TRASH" type="button" class="btn btn-danger btn-outline " onclick="gringosTrash()" >
							<i class="fas fa-trash-alt"></i>
						</button>
					@endif
					</center>
					<div class="row" id="some" style="display: none">
						<span class="" id="respp" style="float: right"></span>	
					</div>
						
					</div>
					<div class="row" id="desce" style="display: none">
						<div class="col-xl-4 col-lg-7" >
						</div>
						<div class="col-xl-4 col-lg-7"  >
							<div class="card shadow mb-4">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary" id="texto">NOVA TAREFA</h6><span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha()"><span class="far fa-times-circle"></span></button></span>
								</div>
								<div class="card-body" id="exibe">
									<center>
										<h3 style="font-family: 'VT323', monospace;">NOVA TAREFA</h3>
										<form method="get" action="{{ route('newtask') }}"  class="user" id="form" onsubmit="event.preventDefault()">
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
											<center><button type="button" class="btn btn-success active" onclick="setTimeout(function() {executa(); },250);" >CONFIRMAR</button>
											</center>
										</form>
										<!-- <x-card-t tipo="success" :mensagem="$mensagem"></x-card-t> -->
									</center>
									</div>
								</div>
							</div>
						
					</div>
					<div class="row justify-content-center"  id="gringosTrash" style="margin-bottom: 10px;display: none">
						<div class="col-xl-6 col-md-6 mb-4  bg-light" >
							<div class="card  border-0 shadow-lg my-5" >
								<div class="card-header bg-primary text-white ">EXCLUIR TAREFA <span style="float: right"><button class="btn btn-danger btn-sm" ><span  onclick="jogaFora()" ><i class="fas fa-times-circle"></i></span></button></span></div>
								<div class="card-body text-center connectedSortable" id="roxolixo" style="min-height: 80px">
									
								</div>
							</div>
						</div>
					</div>
						<!-- <div class="col-xl-4 col-md-6 mb-4  bg-light" >
							<div class="card-sm bg-light " >
								<div class="card-body text-center connectedSortable" id="roxolixo">
									<button class="btn btn-danger" style="margin-top: 8px"><span style="text-align: center;margin: auto" onclick="jogaFora()" ><i class="fas fa-trash-alt fa-3x"></i></span></button>

								</div>
							</div>	
						</div> -->
				
				</div>
				<!-- <input type="hidden"  id="todo"value="{{$quadros[0]['quadro']}}">
				<input type="hidden"  id="doing"value="{{$quadros[1]['quadro']}}">
				<input type="hidden"  id="done"value="{{$quadros[2]['quadro']}}"> -->
				<div class="row" id="app" >
					<quadro-um :tasks="tasks" :todo="{{$quadros[0]['quadro']}}" @primeiro="tasks = $event"></quadro-um>
					<quadro-dois :tasksdois="tasksdois" :doing="{{$quadros[1]['quadro']}}" @segundo="tasksdois = $event"></quadro-dois>
					<quadro-last :taskslast="taskslast" :done="{{$quadros[2]['quadro']}}" @last="taskslast = $event"></quadro-last>
				</div>
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">

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
<div class="modal fade" id="abt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="image-gallery-title" style="font-family: 'VT323', monospace;">NOVA TAREFA</h3>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row" style="padding-bottom: 8px">
						<input type="text" name="tarefa" class="form-control" id="tare" placeholder="TEREFA">

					</div>

					<div class="row"  style="padding-bottom: 8px">	
						<select type="text" name="tecnico" class="form-control" id="tare2">
							<option value="" selected disabled hidden>ESCOLHA UM RESPONSÁVEL</option>
							@foreach($membros as $membro)
							<option value="{{$membro->user->id}}">{{$membro->user->nome}}</option>
							@endforeach
						</select>
					</div>
					<div >
						<center>
							<button type="button" class="btn btn-success " data-dismiss="modal" onclick="refresh()">OK</button>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
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
	function anima(){
		$('#sobe').slideUp('fast',function(){});  
		$('#desce').slideDown('fast',function(){$('#tarefa').focus();});                
	}
	function fecha(){
		$('#desce').slideUp('fast',function(){});  
		$('#sobe').slideDown('fast',function(){});                
	}
	function executa(){
		var form = $('#form');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function(msg) {
    	$("#some").slideDown( "fast", function() {});
        $('#respp').attr('class','alert alert-'+msg[1]);
        document.getElementById('respp').innerHTML = msg[0];
        setTimeout(function() { $("#some").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        //alert('Falha carregando os dados!'+msg);
        $("#some").slideDown( "fast", function() {});
        $('#respp').attr('class','alert alert-danger');
        document.getElementById('respp').innerHTML = msg.responseJSON.errors.tarefa[0];
        setTimeout(function() { $("#some").slideUp( "fast", function() {}); },3500);
        //console.log();
      }
    });
  setTimeout(function() {fecha();reset();},10);
	}
	function reset(){
		
		document.getElementById('exibe').innerHTML = `<center>
										<h3 style="font-family: 'VT323', monospace;">NOVA TAREFA</h3>
										<form method="get" action="{{ route('newtask') }}"  class="user" id="form">
											<div class="form-group">
												<input type="text" class="form-control" name="tarefa" id="tarefa" required="" placeholder="TAREFA AQUI">
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
											<center><button type="button" class="btn btn-success active" onclick="setTimeout(function() {executa(); },250);" >CONFIRMAR</button></center>
										</form>
									</center>`;            
	}
</script>

<a hidden>
	<form method="get" action="{{ route('movetask') }}" class="form-horizontal" id="move" >
		<div id="insert">

		</div>
	</form>
</a>

<a hidden>
	<form method="get" action="{{ route('amarelolixo') }}" class="form-horizontal" id="lixo" >
		<div id="insertlixo">

		</div>
	</form>
</a>
<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






