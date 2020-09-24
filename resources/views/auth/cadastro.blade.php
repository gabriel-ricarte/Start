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
                  <form method="POST" action="{{ route('start.register.post') }}">
                  	@csrf
                  	<div class="form-group row">
                  		<div class="col-sm-6 mb-3 mb-sm-0">
                  			<input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Nome" name="nome">
                  		</div>
                  		<div class="col-sm-6">
                  			<input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Usuario" name="usuario">
                  		</div>
                  	</div>
                  	<div class="form-group">
                  		<input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email" name="email">
                  	</div>
                  	<div class="form-group row">
                  		<div class="col-sm-6 mb-3 mb-sm-0">
                  			<input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
                  		</div>
                  		<div class="col-sm-6">
                  			<input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">
                  		</div>
                  	</div>
                  	@error('password')
                  	<span class="invalid-feedback" role="alert">
                  		<strong>{{ $message }}</strong>
                  	</span>
                  	@enderror
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                     Confirmar
                    </button>
                    <hr>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
@endsection
