@extends('layouts.auth')
@section('login')
disabled
@endsection
@section('conteudo')
<script type="text/javascript">
window.addEventListener("beforeunload", function(e){
   $("#noNo").fadeOut( "fast", function() {$(".loaderr").fadeIn( "fast", function() {});});
}, false);
</script>    

<div class="loaderr" style="display: none">
  <div class="row" >          
    <div id="circle" >
    <h3 style=" font-family: 'VT323', monospace;color: white;display: flex;
  align-items: center">CARREGANDO</h3>
      <div class="loader">
        <div class="loader">
          <div class="loader">
            <div class="loader">
            </div>
          </div>
        </div>
      </div>
     <!--  <h2 style=" font-family: 'VT323', monospace;color: #212121;display: flex;
  align-items: center">CARREGANDO</h2> -->
    </div> 
  </div>
</div>

<div class="row justify-content-center" id="noNo">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo(a)!</h1>
                  </div>
                 <form method="post" action="{{ route('login') }}" class="user">
                        @csrf
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="inputEmail" aria-describedby="Usuario" placeholder="Entre com Usuario..." value="{{ old('usuario') }}" required autofocus name="usuario">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" placeholder="Senha" name="password" autocomplete="current-password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Lembre de Mim</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                     Login
                    </button>
                    <hr>
                  </form>
                  @if (Route::has('password.request'))
                  <div class="text-center">
                    <a class="small" href="{{route('password.request')}}">Esqueceu a Senha?</a>
                  </div>
                  @endif
                  <div class="text-center">
                    <a class="small" href="{{route('register')}}">Crie uma Conta!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
@endsection
