@extends('layouts.dashboard')
@section('titulo')
EQUIPE
@endsection
@section('equipeA','active')
@section('css')

<script type="text/javascript" src="{{asset('js/create-equipe.js')}}"></script>
@endsection
@section('local','CRIANDO EQUIPE')
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
          <div class="card-body p-0" id="app"> 
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-xl-12 col-lg-7" id="desce" style="display: none">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary" id="texto">Buscando dados ...</h6><span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha('desce')"><span class="far fa-times-circle"></span></button></span>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body" id="exibe">
                    <center><div class="loader"></div></center>
                  </div>
                </div>
              </div>
            </div>
              <div class="row" id="linha">

                <div class="col-lg-6" id="seleci">
                  
                 <div class="card shadow mb-4" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">INTEGRANTES SELECIONADOS</h6>
                  </div>
                    @if($projeto->equipe->count() > 0)
                    <integrantes-selecionados :integrantes="integrantes" :projeto="{{$projeto->id}}" @selecionados="integrantes = $event" :csrf="{{ json_encode(csrf_token()) }}" :time="{{$projeto->equipe->first->id->id}}"></integrantes-selecionados>
                    @else
                    <integrantes-selecionados :integrantes="integrantes" :projeto="{{$projeto->id}}" @selecionados="integrantes = $event" :csrf="{{ json_encode(csrf_token()) }}" :time="0"></integrantes-selecionados>
                    @endif  
               
                </div>
              </div>
              <div class="col-lg-6" id="dispon">
               <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary" id="texto-pesquisa">PESQUISE OS INTEGRANTES DISPONÍVEIS </h6>

                </div>
                <integrantes-disponiveis :users="users" :projeto="{{$projeto->id}}"  :csrf="{{ json_encode(csrf_token()) }}" @livres="users = $event"></integrantes-disponiveis>

<!--                 <div class="card-body" id="integrante-form">
                	<form method="POST" action="{{ route('equipe.store') }}" class="user">
                  					@csrf
                	<div class="form-group row">
                		<div class="col-sm-12 mb-3 mb-sm-0">
                			<label for="integrante-nome">Digite Aqui</label>
                			<input type="text" class="form-control " id="integrante-nome" placeholder="Nome ou Email" name="integrante" autofocus="" oninput="pesquisa(this.value)" autocomplete="off" required>
                			<div id="valval" style="display: none"></div>
                			<input type="hidden" name="projeto_id" value="{{$projeto->id}}">
                			<br>
                			<div id="resp" class="col-sm-12">

                			</div>
                		</div>
                	</div>
            </form>
            <span class="alert alert-warning">Se integrante não foi encontrado cadastre <button class="btn btn-warning active btn-sm" onclick="newplayer()">AQUI</button></span>
        </div> -->
        <div class="card-body" id="novo-integrante" style="display: none">
                  <form method="POST" action="{{ route('newplayer') }}" class="user">
                            @csrf
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <label for="nome-new">Nome</label>
                      <input type="text" class="form-control " id="nome-new" placeholder="Nome" name="nome" autocomplete="off" required>
                      <label for="email-new">Email</label>
                      <input type="email" class="form-control " id="email-new" placeholder="Email" name="email" autocomplete="off" required>
                    </div>
                    <input type="hidden" name="projeto" value="{{$projeto->id}}">
                  </div>
                  <button class="btn btn-primary" type="submit">Cadastrar</button>
            </form>
        </div>
      </div>

    </div>
    <div class="col-12" id="btn-confirma">
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
function fecha(id){
    $('#'+id).slideUp('fast',function(){});  
    $('#integranteform').slideDown('fast',function(){});  
    document.getElementById('texto-pesquisa').innerHTML = "PESQUISE OS INTEGRANTES DISPONÍVEIS";              
}
</script>
<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






