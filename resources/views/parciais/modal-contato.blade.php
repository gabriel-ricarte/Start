<div class="modal fade" id="modal-contato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">INSERIR CONTATO</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{ route('insere.contato') }}" method="POST" class="form-group">
          @csrf
        <div class="modal-body">
        
        	<div class="form-group row">
        		<div class="col-sm-12 mb-3 mb-sm-0">
        			<label for="nome-new">Tipo</label>
        			<select type="text" class="form-control" name="tipo" required="" id="tipo" onchange="tipoDesce(this)">
        				<option selected="" value="" hidden="">Tipo do Contato</option>
        				<option value="contatoE">EMAIL</option>
        				<option value="contatoC">CELULAR</option>
        				<option value="contatoT">TELEFONE</option>
        				<option value="contatoR">RAMAL</option>
        			</select>
        			<label for="contato">Contato</label>
        			<input type="email" class="form-control " id="contatoE" placeholder="Email" name="contatoE" autocomplete="off" style="display: none">
        			<input type="text" class="form-control " id="contatoC" placeholder="Celular" name="contatoC" autocomplete="off" style="display: none"> 
        			<input type="text" class="form-control " id="contatoT" placeholder="Telefone" name="contatoT" autocomplete="off" style="display: none">
        			<input type="text" class="form-control " id="contatoR" placeholder="Ramal" name="contatoR" autocomplete="off" style="display: none">
        		</div>
        	</div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="submit" >Confimar</button>
        </div>
        </form>
        <script type="text/javascript">
        	function tipoDesce(tipo){
        		$('#'+tipo.value).slideDown("fast", function() {});
        		$('#'+tipo.value).attr('required','required');
        	}
        	$(document).ready(function($){
        		$('#contatoC').mask('(00) 0 0000-0000');
        		$('#contatoT').mask('(00) 0000-0000');
        		$('#contatoR').mask('0000');
        	});
        </script>
    </div>
  </div>
</div>