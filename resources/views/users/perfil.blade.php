@extends('layouts.dashboard')
@section('titulo')
PERFIL
@endsection
@section('perfilA','active')
@section('local','PERFIL')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
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
           <!--  <form method="post"> -->
                <div class="row">
                    <div class="col-md-4" id="div_img">
                        <img src="../../images/user p.png" alt=""  />
                    </div>
                    <div class="col-md-6" id="div_info">
                        <div class="profile-head">
                                    <h5>
                                        {{$user->nome}}
                                    </h5>
                                    <h6>
                                        {{$user->email}}
                                    </h6>
                                   <!--  <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sobre</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <!-- <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editar Perfil" onclick="$('#div_img').slideUp('fast');$('#div_info').slideUp('fast');$('#sobe').slideUp('fast', function(){$('#form_edit_perfil').slideDown('fast'); $('#btn_edit').attr('class','profile-edit-btn btn-primary ');$('#btn_edit').attr('value','Editando...')}); " id="btn_edit" /> -->
                        <a href="#" data-toggle="modal" data-target="#oops"><button class="btn btn-primary">Editar</button></a>
                    </div>
                </div>
                <div class="row" id="sobe">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->id}}</p>
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
                                               
                                            </div>
                                        </div>
                                        
                            </div>
                        </div>
                    </div>
                </div>
                <div id="form_edit_perfil" style="display: none">
                    <form method="post" action="{{ route('register') }}" class="user">
                        @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img" >
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="nome" placeholder="Nome" name="nome" value="{{$user->nome}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                
                            </div>
                            <div class="col-sm-6">
                               
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            
                         </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Confirmar Alterações
                </button>
                
              </form>
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