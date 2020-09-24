@extends('layouts.dashboard')
@section('titulo')
KANBAN 
@endsection
@section('js')
  	<script type="text/javascript" src="{{asset('js/jquery-1.9.js')}}"></script>
  	<script type="text/javascript" src="{{asset('js/jqueryui-certo.js')}}"></script>

  	<!-- javascript dos cards e paineis -->
   	<script type="text/javascript" src="{{asset('js/paineis3.js')}}"></script>
@endsection
@section('css')
<!-- <link href="{{asset('css/agency.min.css')}}" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="{{asset('css/wobble.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/tabs.css')}}"> -->
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
			<div class="container-fluid" id="articlee">
								<div class="container" style="margin-top: -18px;">
									<br>
									<div class="row">
										<div class="col-4">
										</div>
										<div class="col-4">
											<a  href="#" data-image-id="" data-toggle="modal" data-target="#abt" style="text-decoration: none" >
												<button type="button" class="btn btn-danger btn-outline btn-sm btn-block" ><i class="fa fa-plus"></i></button>
											</a>
										</div>
									</div>
								</div>
				<div class="row" id="recharP" >
					@forelse($kanban->quadros as $quadro)
					<div class="col-xl-4 col-md-6 mb-4  bg-light" id="quadro{{$quadro->id}}">
						<div class="card  border-0 shadow-lg my-5" >
							<div class="card-header btn btn-lg btn-info">{{$quadro->nome}}</div>
							<div class="card-body connectedSortable" id="draggablePanelList{{$loop->iteration}}" data-value="{{$quadro->id}}" style="min-height: 80px">
								@forelse($quadro->tasks_ativas as $task)
									 <div class="card pan dragg qitem btn btn-success" id="{{$task->id}}"  data-value="{{$quadro->id}}" style="position: relative;">	
										<div class="card-body" >
											<!-- <div class="container"> -->
												<h5 class="text-center">{{$task->task->task}}</h5>
												<small class=" bottom-right" style="float: right">{{$task->tecnico->nome}}</small>
											<!-- </div> -->
										</div>
									</div>
								@empty
								@endforelse
								@if($loop->last)
								@forelse($quadro->tasks_finalizadas as $task)
								<div class="card pan dragg qitem btn btn-light" id="{{$task->id}}"  data-value="{{$quadro->id}}" style="position: relative;">	
										<div class="card-body" >
											<!-- <div class="container"> -->
												<h5 class="text-center">{{$task->task->task}}</h5>
												<small class=" bottom-right" style="float: right">{{$task->tecnico->nome}}</small>
											<!-- </div> -->
										</div>
									</div>
								@empty
								@endforelse
								@endif

							</div>
						</div>
					</div>
					
					@empty
					@endforelse	
				
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
								<option value="{{$membro->tecnico->id}}">{{$membro->tecnico->nome}}</option>
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
	

  function refresh(){
  
    document.getElementById('inserir').innerHTML = 
    `
    <input type="text" name="tarefa"  class="form-control col-12" value="`+$('#tare').val()+`" required>
    <input type="text" name="tecnico"  class="form-control col-12" value="`+$('#tare2').val()+`" required >
    <input type="text" name="projeto"  class="form-control col-12" value="{{$projeto->id}}" required >	
    
    `
    ;

    setTimeout(function() { ale(); },100);
  }
</script>
<a hidden>
	<form method="get" action="{{ route('newtask') }}" class="form-horizontal" id="cinza" >
							<input type="text" name="id" value="{{$kanban->id}}">
							<div id="inserir">

							</div>
						</form>
					</a>

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






