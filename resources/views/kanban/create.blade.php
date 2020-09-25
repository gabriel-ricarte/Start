@extends('layouts.dashboard')
@section('titulo')
CRIANDO KANBAN
@endsection
@section('projetoA','active')
@section('local','CRIANDO KANBAN')
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

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-2">
							</div>
							<div class="col-lg-8">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">CRIE SEU KANBAN ! <button class="btn btn-danger btn-circle" data-toggle="popover" title="Campos Obrigatórios" data-content="Todos os campos com texto são obrigatórios"><span class="fa fa-info"></span></button></h1>
									</div>
									<form method="POST" action="{{ route('kanban.store') }}" class="user">
                  					@csrf
                  					<input type="hidden" name="segundo" value="1">
										<div class="form-group row">
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control form-control-user text-uppercase" id="nome" placeholder="Nome do Kanban / Estágio" name="nome" required autocomplete="off">
											</div>
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control form-control-user" id="desc" placeholder="Descrição" name="descricao" required autocomplete="off">
											</div>

										</div>

										<div class="form-group row">
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="date" class="form-control " id="data_ini" min="{{date('Y-m-d')}}" max="{{$projeto->data_fim}}" name="data_ini" required >
											</div>
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control " id="data_fim" placeholder="Previsão de finalização" name="data_fim" required onfocus="muda(this)" min="{{date('Y-m-d')}}" max="{{$projeto->data_fim}}">
											</div>

										</div>
										<center><h4>QUADROS NECESSÁRIOS PARA O KANBAN</h4></center>
										<div class="form-group row" id="some">
											<div class="col-sm-4 mb-3 mb-sm-0">
												 <a href="#" data-toggle="modal" data-target="#dev">
												 	<button class="btn btn-danger">3 RAIAS</button>
												 </a>
											</div>
											<!-- <div class="col-sm-4 mb-3 mb-sm-0">
												<a href="#" data-toggle="modal" data-target="#devo">
												 	<button class="btn btn-danger">4 RAIAS</button>
												 </a>
											</div>
											<div class="col-sm-4 mb-3 mb-sm-0">
												<a href="#" data-toggle="modal" data-target="#devu">
												 	<button class="btn btn-danger">LIVRE</button>
												 </a>
											</div> -->
										</div>

										<center>
										
											<input type="hidden" name="tipo" id="resp_tipo" value="3">
										
										<input type="hidden" name="projeto_id" value="{{$projeto->id}}">
										<button type="submit" class="btn btn-primary ">
											CONFIRMAR
										</button>
</center>
									</form>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>



<script type="text/javascript">
	function muda(id){
		//console.log(id.val());
		$(id).attr('type','date');
	}
</script>
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
<script>


</script>


  <div class="modal fade" id="dev" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">3 RAIAS</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecione esta opção se seu quadro só necessita de três raias.<br>
        	<div class="row">
	        	<div class="card col-4"><button class="btn btn-primary btn-block">A FAZER</button></div>
	        	<div class="card col-4"><button class="btn btn-primary btn-block">FAZENDO</button></div>
	        	<div class="card col-4"><button class="btn btn-primary btn-block">FEITO</button></div>
        	</div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="tipagem(3)">Confirmar</button>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="devo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">4 RAIAS</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecione esta opção se seu quadro só necessita de quatro raias.<br>
        	<div class="row">
	        	<div class="card col-3"><button class="btn btn-primary btn-block">A FAZER</button></div>
	        	<div class="card col-3"><button class="btn btn-primary btn-block">FAZENDO</button></div>
	        	<div class="card col-3"><button class="btn btn-primary btn-block">TESTE</button></div>
	        	<div class="card col-3"><button class="btn btn-primary btn-block">FEITO</button></div>
        	</div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="tipagem(4)">Confirmar</button>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="devu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Oops</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Opa, essa opção não ainda está disponível... <span class="far fa-grin-beam-sweat fa-x1" > </span> <.<br>
        	<!-- <div class="row">
	        	<div class="card col-3"><button class="btn btn-primary btn-block">A FAZER</button></div>
	        	<div class="card col-3"><button class="btn btn-primary btn-block">FAZENDO</button></div>
	        	<div class="card col-3"><button class="btn btn-primary btn-block">TESTE</button></div>
	        	<div class="card col-3"><button class="btn btn-primary btn-block">FEITO</button></div>
        	</div> -->
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
         <!--  <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="tipagem(4)">Confirmar</button> -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	function tipagem(num){
		if(num == 3){
			document.getElementById('some').innerHTML = ``;
			document.getElementById('some').innerHTML = `<div class="col-sm-4 mb-3 mb-sm-0"></div><div class="col-sm-4 mb-3 mb-sm-0"><button class="btn btn-danger btn-block">3 RAIAS</button></div>`;
			$('#resp_tipo').attr('value',3);
		}
		if(num == 4){
			document.getElementById('some').innerHTML = ``;
			document.getElementById('some').innerHTML = `<div class="col-sm-4 mb-3 mb-sm-0"></div><div class="col-sm-4 mb-3 mb-sm-0"><button class="btn btn-danger btn-block">4 RAIAS</button></div>`;
			$('#resp_tipo').attr('value',4);
		}
	}
</script>
<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






