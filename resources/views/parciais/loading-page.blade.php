<script type="text/javascript">

window.addEventListener("beforeunload", function(e){
   $("#wrapper").fadeOut( "fast", function() {$(".loaderr").fadeIn( "fast", function() {});});
}, false);
</script>    

<div class="loaderr" style="display: none">
	<center><img src="../../images/logo teste.png"></center>
  <!-- <center> NÚCLEO DE DESENVOLVIMENTO JANGADEIRO</center> -->
  <div class="row" >          
    <div id="circle" >
    <h2 style=" font-family: 'VT323', monospace;color: #212121;display: flex;
  align-items: center">CARREGANDO </h2>
      <div class="loade">
        <div class="loade">
          <div class="loade">
            <div class="loade">
            </div>
          </div>
        </div>
      </div>
     <!--  <h2 style=" font-family: 'VT323', monospace;color: #212121;display: flex;
  align-items: center">CARREGANDO</h2> -->
    </div> 
  </div>
</div>