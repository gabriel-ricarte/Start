@extends('layouts.auth')
@section('cadastro')
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
                    <h1 class="h4 text-gray-900 mb-4">Opa, essa opção não está disponível... <span class="far fa-grin-beam-sweat fa-x1" > </span> </h1>
                   
                  </div>
                  @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado para seu Email.') }}
                        </div>
                    @endif
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Verifique seu endereço de Email.</h1>
                    <h2 class="h4 text-gray-900 mb-4">Se você não recebeu o email</h2>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para enviar outro email') }}</button>.
                    </form>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
@endsection
