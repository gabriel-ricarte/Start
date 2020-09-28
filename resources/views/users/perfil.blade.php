@extends('layouts.dashboard')
@section('titulo')
PERFIL
@endsection
@section('perfilA','active')
@section('local','PERFIL')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/perfil.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/loading.min.css')}}"> -->
@endsection
@section('conteudo')

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

          <!-- conteudo aqui -->
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{$user->avatar}}" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Mudar Foto
                                <!-- <input type="file" name="file"/> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{$user->nome}}
                                    </h5>
                                    <h6>
                                        {{$user->vertical}}
                                    </h6>
                                    <p class="proile-rating">PROJETOS : <span>{{$user->projeto->count()}}</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sobre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Projetos</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Editar Perfil"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                        </div> -->
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Matrícula Usuário</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->matricula}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nome</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->nome}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Contato</label>
                                            </div>
                                            <div class="col-md-6">
                                              @if($user->contatos->count() == 0 )
                                              <button class="badge badge-primary">ADICIONAR</button>
                                              @else
                                              <p>{{$user->contato}}</p>
                                              @endif 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Setor</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->setor}}</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tarefas completas</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>25</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Horas Trabalhadas</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>10 hrs</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Total Projetos</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>2</p>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Availability</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>6 months</p>
                                            </div>
                                        </div>-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Sua Biografia</label><br/>
                                        <p>As experiências acumuladas demonstram que o surgimento do comércio virtual exige a precisão e a definição dos métodos utilizados na avaliação de resultados.</p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
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

  <!-- Logout Modal-->
  @include('parciais.modal-logout')
	@include('parciais.modal-oops')

  <script type="text/javascript">
    function roda(){

      var twoToneButton = document.querySelector('#btn_edit');
      twoToneButton.classList.add('ld-spin');
    }
    
  </script>
@endsection