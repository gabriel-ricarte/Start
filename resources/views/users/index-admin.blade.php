@extends('layouts.dashboard')
@section('titulo')
Admins
@endsection
@section('usersA','active')
@section('local','ADMINS')
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

         <div class="row">
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">TODOS OS ADMINS</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                 <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NOME</th>
                      <th>CONTATO</th>
                      <th>STATUS</th>
                      <th>AÇÕES</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@forelse($users as $user)
                    <tr>
                      <td>{{$user->nome}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                      	@if($user->status == 1)
                      	ATIVO
                      	@else
                      	INATIVO
                      	@endif
                      </td>
                      <td><!-- <button class="btn btn-success"><span class="fas fa-sync-alt"></span></button>  --><a href="{{route('admins.activate',$user->id)}}"> <button class="btn btn-danger" ><span class="fas fa-sync-alt"></span></button></a></td>
                      
                    </tr>
                    @empty
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button class="btn btn-danger">into non existe !</button></td>
                      <td></td>
                      <td></td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
                </div>
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include('parciais.modal-logout')
  @include('parciais.modal-oops')
@endsection






