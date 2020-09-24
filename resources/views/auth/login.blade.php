@extends('layouts.auth')

@section('conteudo')

       <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem Vindo(a) ao Start Jangadeiro</h1>
                  </div>
                  <div class="form-group">
                      Utilize o email da empresa para acessar o sistema.
                      <br>
                      <center><a href="/login/google" style="text-decoration: none"><button class="btn btn-lg btn-danger"><span class="fab fa-google fa-5x" style="color: white"></span></button></a></center>
                  </div>
                </div>
              </div>
              @if(count($errors)>0)
              <div class="alert alert-danger" id="fecha">
                  <ul>
                      @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
            </div>
          </div>
        </div>

      </div>

    </div>
@endsection
