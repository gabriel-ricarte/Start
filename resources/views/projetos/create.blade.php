@extends('layouts.dashboard')
@section('titulo')
NOVO PROJETO
@endsection
@section('projetoA','active')
@section('local','NOVO PROJETO')
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
	function muda(id){
		//console.log(id.val());
		$(id).attr('type','date');
	}
	function muda2(){
		document.getElementById('change').innerHTML = '';
		document.getElementById('change').innerHTML = 
		`
		<select type="text" name="vertical" required class="form-control"><option selected="" hidden="" value="">ESCOLHA AQUI</option><option>HOLDING</option><option>JORNAL JANGADEIRO</option><option>TODO MUNDO AMA</option><option>FUTEBOLÊS</option>></select>
		`;
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
<a hidden>
  <form method="get" action="{{route('busca.pessoa')}}" class="form-horizontal" id="buscaC" >
        <div id="inserir">

        </div>
  </form>
</a>
<script>
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});
	function tu(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#tumb')
			.attr('src', e.target.result)
			.width(210)
			.height(150);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
function pesquisa(dado){
  document.getElementById('resp').innerHTML = 
    `<h3>BUSCANDO ...</h3>
    `
    ;if(dado.length>=3){
    document.getElementById('inserir').innerHTML = 
    `
    <input type="text" name="dado"  class="form-control col-12" value="`+dado+`" required>
    
    `
    setTimeout(function() { executaBusca(); },10);
    }else{
    	  document.getElementById('resp').innerHTML = 
    `<h3>BUSCANDO ...</h3>
    `

    }
    
  
}


 function executaBusca(){
  var form = $('#buscaC');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  var show =  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function() {
      
      document.getElementById('resp').innerHTML = 
      `<div class="table-responsive" style="font-size: medium"> 
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" id="style-9">
                      <thead>
                        <tr id="tablee" style="font-size: medium">
                          <th >USUÁRIO</th>
                          <th>EMAIL</th>
                          <th>SETOR</th>
                          <th>AÇÃO</th>
                        </tr>
                      </thead>
                      <tbody id="tableee" class="bg-light">
                      </tbody>
                    </table>
                  </div>
`;
      },
      error: function(){
        document.getElementById('resp').innerHTML = 'busca sem resultados';
      }
    });
 
		show.done(function(dat){ 
			console.log();
			
			 for(let i = 0 ; i < dat.length; i++){
			 	let hora = 
			 	`
			 	<tr style="font-size: medium">
			 	<td>`+  
                 dat[i].nome
             	+`</td>
                <td>`+  
             	dat[i].email
              	+`</td>
                <td>`+ 
             	dat[i].setor
                +`</td>
                <td>
               	<button class="btn btn-success btn-sm" type="button" onclick="selecionar('`+dat[i].nome+`',`+dat[i].id+`)">SELECIONAR </button>
                </td>
				</tr> `;
                $('#tableee').append(hora);
			 }
		});

}
function eLaVamosNos(){
  $('#po').attr('value','');
  document.getElementById('po').value = '';
  document.getElementById('valval').innerHTML = '';
  $('#po').removeAttr('readonly');
  $('#po').focus();
  document.getElementById('resp').innerHTML = '';
}
function selecionar(nome,id){
	$('#po').attr('value',nome);
	$('#po').attr('readonly','true');
	document.getElementById('resp').innerHTML = '<button class="btn btn-info btn-sm" onclick="eLaVamosNos()" type="button"><span class="fas fa-user-edit"></span></button>';
	document.getElementById('valval').innerHTML = '<input  type="hidden" value="'+id+'" name="po_id" required>';
	document.getElementById('po').value = nome;
	$('#razao').focus();
	}
</script>
<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






