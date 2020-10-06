@extends('layouts.dashboard')
@section('titulo')
NOVO PROJETO
@endsection
@section('projetoA','active')
@section('local','NOVO PROJETO')
@section('js')
<script type="text/javascript" src="{{asset('js/create-projeto.js')}}"></script>
@endsection
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
										<h1 class="h4 text-gray-900 mb-4">INFORMAÇÕES PRINCIPAIS <button class="btn btn-danger btn-circle" data-toggle="popover" title="Campos Obrigatórios" data-content="Todos os campos com texto são obrigatórios"><span class="fa fa-info"></span></button></h1>
									</div>
									<form method="POST" action="{{ route('projeto.store') }}" class="user" enctype="multipart/form-data">
                  					@csrf
										<div class="form-group row">
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control form-control-user" id="nome" placeholder="Nome do Projeto" name="nome" required autocomplete="off">
												
											</div>
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control form-control-user" id="desc" placeholder="Descrição" name="descricao" required autocomplete="off">
											</div>

										</div>
										<div class="form-group row">
											<div class="col-sm-12 mb-3 mb-sm-0">
												<input type="text" class="form-control form-control-user" id="po" placeholder="P.O  (Product Owner)" name="po" required oninput="pesquisa(this.value)" autocomplete="off">
												<div id="valval" style="display: none"></div>
												<br>
												<div id="resp">
                    							</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control form-control-user" id="desc" placeholder="Sponsor  (Centro de custo do projeto)" name="spo" required>
											</div>
											<div class="col-sm-6 mb-3 mb-sm-0" id="change">
												<input type="text" class="form-control form-control-user" id="vertical" placeholder="Vertical do projeto" name="vertical" required onfocus="muda2()">
											</div>

										</div>
										<div class="form-group row">
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control " id="data_ini" placeholder="Previsão de inicio" name="data_ini" required onfocus="muda(this)">
											</div>
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="text" class="form-control " id="data_fim" placeholder="Previsão de finalização" name="data_fim" required onfocus="muda(this)">
											</div>

										</div>
										<div class="form-group row">
											<div class="col-sm-6 mb-3 mb-sm-0">
												<input type="file" id="game_image" name="imagem" class="form-control " onchange="tu(this);">
											</div>
											<div class="col-sm-6 mb-3 mb-sm-0">
												<center> <img src="../../images/gears.png" id="tumb" width="60" height="60"></center>
											</div>
										</div>
										<center>
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
<div id="app"></div>


<script type="text/javascript">

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
<a hidden>
  <form method="get" action="{{route('busca.pessoa')}}" class="form-horizontal" id="buscaC" >
        <div id="inserir">

        </div>
  </form>
</a>
<!-- <a hidden>
  <form method="get" action="{{route('busca.pessoa')}}" class="form-horizontal" id="buscaC" >
        <div id="inserir">

        </div>
  </form>
</a> -->

<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






