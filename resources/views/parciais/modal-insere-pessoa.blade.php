<div class="modal fade" id="modal-newp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">INSERIR PARTICIPANTE</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        	<div class="form-group row">
        		<div class="col-sm-12 mb-3 mb-sm-0">
        			<label for="nome-new">Nome</label>
        			<input type="text" class="form-control " id="nome-new" placeholder="Nome" name="nome" autocomplete="off" required>
        			<label for="email-new">Email</label>
        			<input type="email" class="form-control " id="email-new" placeholder="Email" name="email" autocomplete="off" required>
        		</div>
        	</div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button" data-dismiss="modal" onclick="preparaInsercao()">Confimar</button>
        </div>
    </div>
  </div>
</div>