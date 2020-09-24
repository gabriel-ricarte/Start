@extends('layouts.dashboard')
@section('titulo')
EQUIPE
@endsection
@section('equipeA','active')
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/wobble.css')}}"> -->
@endsection
@section('local','CRIANDO EQUIPE')
@section('conteudo')
@include('parciais.loading-page')
<!-- Page Wrapper -->
<div id="wrapper">
<div id="app">  <input type="hidden"  id="todo"value="0">
				<input type="hidden"  id="doing"value="0">
				<input type="hidden"  id="done"value="0"></div>
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
            
              <div class="row" id="linha">

                <div class="col-lg-6" id="seleci">
                  
                 <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">INTEGRANTES SELECIONADOS</h6>
                  </div>
                  <div class="card-body">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                      <tr>
                        <th>NOME</th>
                        <th>PERMISSÃO</th>
                        <th>CONTATO</th>
                        <th>AÇÕES</th>
                      </tr>
                    </thead>
                    <tbody id="selec">
                     @forelse($integrantes as $integrante)
                        <tr>
                          <td>{{$integrante->user->nome}}</td>
                          <td> 
                            <button type="button" class="btn btn-danger hvr-bounce-in btn-sm " title="NÍVEL DE PERMISSÃO" data-container="body" data-toggle="popover" data-placement="top" data-content="Pode criar , editar e excluir tarefas" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;"   onclick="pop();"onmouseover="pop()" >
                                TOTAL
                            </button>
                          <!-- <button type="button" class="btn btn-warning hvr-bounce-in btn-sm " title="EDITAR PERMISSÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;display:none" onclick="" id="criar{{$integrante->user->id}}" >
                            CRIAR
                          </button>
                          <button type="button" class="btn btn-success hvr-bounce-in btn-sm " title="EDITAR PERMISSÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;display:none" onclick="" id="ver{{$integrante->user->id}}" >
                            VER
                          </button> -->
                          </td>
                          <td> {{$integrante->user->email}}</td>
                          <td> 
                            <button type="button" class="btn btn-info hvr-bounce-in btn-sm" title="INFORMAÇÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px" onclick="see({{$integrante->user->id}})" >
                              <i class="far fa-eye" ></i>
                            </button>
                            <button type="button" class="btn btn-warning hvr-bounce-in btn-sm " title="EDITAR PERMISSÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;" onclick="psee({{$integrante->user->id}})" >
                              <i class="far fa-edit" ></i>
                            </button>
                          </td>
                        </tr>
                        
                        @empty
                        <div class="row" id="chome">
                          <div class="col-4">
                            ESCOLHA SEU TIME :D !!

                          </div>
                        </div>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
               
                </div>
              </div>
              <div class="col-lg-6" id="dispon">
               <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">PESQUISE OS INTEGRANTES DISPONÍVEIS </h6>

                </div>
                <div class="card-body">
                	<form method="POST" action="{{ route('equipe.store') }}" class="user">
                  					@csrf
                	<div class="form-group row">
                		<div class="col-sm-12 mb-3 mb-sm-0">
                			<label for="integrante">Digite Aqui</label>
                			<input type="text" class="form-control " id="integrante" placeholder="Nome ou Email" name="integrante" autofocus="" oninput="pesquisa(this.value)" autocomplete="off" required>
                			<div id="valval" style="display: none"></div>
                			<input type="hidden" name="projeto_id" value="{{$projeto->id}}">
                			<br>
                			<div id="resp" class="col-sm-12">

                			</div>
                		</div>
                	</div>
            </form>
        </div>
      </div>

    </div>
    <div class="col-12">
    	 @if($integrantes->count() > 0)
    <center><a href="{{route('equipe.show',$projeto->id)}}" style="text-decoration: none"><button class="btn btn-primary btn-lg">CONFIRMAR</button></a></center>
    <br><br>
    @endif
    </div>
   
  </div>

</div>
  



  <a hidden>
    <form method="get" action="{{ route('newplayer') }}" class="form-horizontal" id="cinza" >
      <div id="inserir">

      </div>
    </form>
  </a>
  <a hidden>
    <form method="get" action="{{ route('moveplayer') }}" class="form-horizontal" id="azul" >
      <div id="insblue">

      </div>
    </form>
  </a>
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
        <div id="inserirr">

        </div>
  </form>
</a>
 
<script type="text/javascript">

function pop(){
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
  });
}
  
  	function pesquisa(dado){
  document.getElementById('resp').innerHTML = 
    `<h3>BUSCANDO ...</h3>
    `
    ;if(dado.length>=3){
    document.getElementById('inserirr').innerHTML = 
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
      `<div class="table-responsive" > 
            <table class="table table-striped table-sm " id="style-9">
                      <thead>
                        <tr id="tablee" style="font-size: small">
                          <th>USUÁRIO</th>
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
			 	<tr style="font-size: smaller">
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
  $('#integrante').attr('value','');
  document.getElementById('integrante').value = '';
  document.getElementById('valval').innerHTML = '';
  $('#integrante').removeAttr('readonly');
  $('#integrante').focus();
}

function selecionar(nome,id){
	$('#integrante').attr('value',nome);
	$('#integrante').attr('readonly','true');
	document.getElementById('resp').innerHTML = '<button class="btn btn-info btn-sm" onclick="eLaVamosNos()" type="button"><span class="fas fa-undo-alt"></span></button> <button class="btn btn-danger btn-sm" onclick="selecionado()" type="submit"><span class="fas fa-user-plus"></span></button> ';
	document.getElementById('valval').innerHTML = '<input  type="hidden" value="'+id+'" name="integrante_id" required>';
	document.getElementById('integrante').value = nome;
	$('#razao').focus();
	}
</script>
<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






