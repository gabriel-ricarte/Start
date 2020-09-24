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
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Seu cadastro precisa ser feito pela TI Jangadeiro.</h1>
                    <h2 class="h4 text-gray-900 mb-4">Ramal : 2078</h2>
                    <h2 class="h4 text-gray-900 mb-4">Email : gabriel@jangadeiro.com.br</h2>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
@endsection
