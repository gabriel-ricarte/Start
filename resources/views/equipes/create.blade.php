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
                     @forelse($tecnicos as $tecnico)
                     @if($tecnico->escolhido == 1)
                     
                        <tr>
                          <td>{{$tecnico->nome}}</td>
                          <td> 
                            <button type="button" class="btn btn-danger hvr-bounce-in btn-sm " title="NÍVEL DE PERMISSÃO" data-container="body" data-toggle="popover" data-placement="top" data-content="Pode criar , editar e excluir tarefas" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;"   onclick="pop();"onmouseover="pop()" >
                                TOTAL
                            </button>
                          <!-- <button type="button" class="btn btn-warning hvr-bounce-in btn-sm " title="EDITAR PERMISSÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;display:none" onclick="" id="criar{{$tecnico->id}}" >
                            CRIAR
                          </button>
                          <button type="button" class="btn btn-success hvr-bounce-in btn-sm " title="EDITAR PERMISSÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;display:none" onclick="" id="ver{{$tecnico->id}}" >
                            VER
                          </button> -->
                          </td>
                          <td> {{$tecnico->email}}</td>
                          <td> 
                            <button type="button" class="btn btn-info hvr-bounce-in btn-sm" title="INFORMAÇÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px" onclick="see({{$tecnico->id}})" >
                              <i class="far fa-eye" ></i>
                            </button>
                            <button type="button" class="btn btn-warning hvr-bounce-in btn-sm " title="EDITAR PERMISSÕES" style="border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;" onclick="psee({{$tecnico->id}})" >
                              <i class="far fa-edit" ></i>
                            </button>
                          </td>
                        </tr>
                        @endif
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
                  <h6 class="m-0 font-weight-bold text-primary">INTEGRANTES DISPONÍVEIS   <span style="float: right"><a  data-image-id="" data-toggle="modal"
                    data-target="#newplayer"href="newplayer" style="text-decoration:none;">
                    <button type="button" class="btn btn-danger btn-circle" title="ADICIONAR NOVA PESSOA" >
                      <i class="fas fa-user-plus"></i>
                    </button>
                  </a></span> </h6>

                </div>
                <div class="card-body">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                    <tr>
                      <th>NOME</th>
                      <th>SETOR</th>
                      <th>CONTATO</th>
                      <th>AÇÕES</th>
                    </tr>
                  </thead>
                  <tbody id="dispss">
                   @forelse($tecnicos as $tecnico)
                   @if($tecnico->escolhido == 0)
                   <tr>
                    <td>{{$tecnico->nome}}</td>
                    <td> {{$tecnico->setor}}</td>
                    <td> {{$tecnico->email}}</td>
                    <td> <button type="button" class="btn btn-success btn-sm hvr-bounce-in" title="ADICIONAR A EQUIPE"  onclick="this.disabled=true;reblue({{$tecnico->id}})" id="play{{$tecnico->id}}" >
                      <i class="fa fa-plus" ></i>
                    </button>
                  </td>


                </tr>
                
                @endif
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
    


  </div>
<div class="row">
    <form method="post" action="{{route('criar.time')}}" class="form-horizontal" id="formmm"  role="form" enctype="multipart/form-data">
                  @csrf
                  @forelse($tecnicos as $tecnico)
                  @if($tecnico->escolhido == 1)
                  <input type="hidden" name="permis[]" value="0">
                  <input type="hidden" name="integrantes[]" value="{{$tecnico->id}}">
                  @endif
                  @empty
                  @endforelse
                  <input type="hidden" name="projeto_id" value="{{$projeto->id->id}}">
                    
      <div class="col-5"></div>
       <div class="col-5"><center><button class="btn btn-danger btn-lg">CONFIRMAR </button></center></div>
      <br><br><br>
       </form>
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
<div id="app">  <input type="hidden"  id="todo"value="0">
        <input type="hidden"  id="doing"value="0">
        <input type="hidden"  id="done"value="0"></div>
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="moveplayer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-lg-12 text-center"> 
         <center> <h2 class="btn btn-primary col-12 align-self-center text-center" id="labelB">{{ __('INTEGRANTE DE EQUIPE') }}</h2></center>
       </div>
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
       </button>
     </div>
     <div class="modal-body">
      <div class="container" >
       <div class="row">
         <div class="col-lg-12 text-center"> 
           <center>
             <button type="button" class="btn btn-success"  data-dismiss="modal">CONFIRMAR</button>
           </center>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
<div class="modal fade" id="newplayer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-lg-12 text-center"> 
         <center> <h2 class="btn btn-danger col-12 align-self-center text-center">{{ __('NOVO INTEGRANTE') }}</h2></center>
       </div>
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
       </button>
     </div>
     <div class="modal-body">
      <div class="container" >
        <div class="row">
          <div class="form-group col-md-4" >
            <label class="btn btn-primary col-12 text-center" id="labelB">{{ __('NOME') }}</label>
            <input type="text" id="newplayer_name"  class="form-control col-12" placeholder="NOME E SOBRENOME" >
          </div>
          <div class="form-group col-md-4">
           <label class="btn btn-primary col-12 align-self-center text-center" id="labelB" >{{ __('CONTATO') }}</label>
           <input type="email"  id="newplayer_contact"  class="form-control col-12" placeholder="EMAIL" >
           <input type="phone"  id="newplayer_celphone"  class="form-control col-12" placeholder="CELULAR"  >
         </div>
         <div class="form-group col-md-4">
           <label class="btn btn-primary col-12 align-self-center text-center" id="labelB" >{{ __('SETOR') }}</label>
           <input type="text" id="newplayer_setor"  class="form-control col-12" >
         </div>
       </div>
       <div class="row">
         <div class="col-lg-12 text-center"> 
           <center>
            <button type="button" class="btn btn-success" onclick="refresh()"  data-dismiss="modal">CONFIRMAR</button>
          </center>
        </div>
      </div>
    </div>

    <!-- CONTEUDO ADICIONAR NOVO STAGE-->
  </div>
</div>
</div>
</div>  
<script type="text/javascript">
  function refresh(){
    document.getElementById('inserir').innerHTML = 
    `
    <input type="text" name="nome"  class="form-control col-12" value="`+$('#newplayer_name').val()+`" required="required" >
    <input type="email"  name="email"  class="form-control col-12" value="`+$('#newplayer_contact').val()+`" required="required">
    <input type="text"  name="contato"  class="form-control col-12" value="`+$('#newplayer_celphone').val()+`" required="required">
    <input type="text" name="setor"  class="form-control col-12" value="`+$('#newplayer_setor').val()+`" required="required" >
    `
    ;

    setTimeout(function() { ale(); },100);
  }
  function ale(){
  //div.style.display="none";

  var form = $('#cinza');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function(msg) {
        //alert('deu certo');
      },
      error: function(){
        //alert('Falha carregando os dados!');
      }
    });
  $("#linha").load(location.href+" #linha>*","");
  $("#newplayer").load(location.href+" #newplayer>*","");


}
// function ref(){
//   $("#linha").load(location.href+" #linha>*","");
// }
function reblue(id){
  document.getElementById('insblue').innerHTML = 
  `
  <input type="text" name="tecnico_id"  class="form-control col-12" value="`+id+`" required="required" >
  `
  ;

  setTimeout(function() { aleblue(); },100);
}
function aleblue(){
  //div.style.display="none";

  var form = $('#azul');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function(msg) {
        //alert('deu certo');
      },
      error: function(){
        //alert('Falha carregando os dados!');
      }
    });
  $("#seleci").load(location.href+" #seleci>*","");
  $("#dispon").load(location.href+" #dispon>*","");
  $("#formmm").load(location.href+" #formmm>*","");


}

function pop(){
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
  });
}
</script>
<!-- Logout Modal-->
@include('parciais.modal-logout')
@endsection






