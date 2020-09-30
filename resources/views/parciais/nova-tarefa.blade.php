<div class="row" id="novaTarefaDiv" style="display: none">
	<div class="col-xl-4 col-lg-7" >
	</div>
	<div class="col-xl-4 col-lg-7"  >
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary" id="texto">NOVA TAREFA</h6><span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha('novaTarefaDiv')"><span class="far fa-times-circle"></span></button></span>
			</div>
			<div class="card-body" id="formNovaTarefa">
				<center>
					<h3 style="font-family: 'VT323', monospace;">NOVA TAREFA</h3>
					<form method="get" action="{{ route('newtask') }}"  class="user" id="formTarefa" onsubmit="event.preventDefault()">
						<div class="form-group">
							<input type="text" class="form-control" name="tarefa" id="tarefa" required="" placeholder="TAREFA AQUI" autocomplete="off">
							<input type="hidden" name="id" value="{{$kanban->id}}">

						</div>
						<div class="form-group">
							<label for="integrante">INTEGRANTE RESPONSÁVEL PELA TAREFA</label>
							<select type="text" class="form-control" id="integrante" required="" name="tecnico">
								<option selected="" hidden="" value="">ESCOLHA AQUI</option>
								@foreach($membros as $membro)
								<option value="{{$membro->user->id}}">{{$membro->user->nome}}</option>
								@endforeach
							</select>	 								
						</div>
						<center>
							<button type="button" class="btn btn-success active" onclick="setTimeout(function() {executaFormNovaTarefa(); },250);" >CONFIRMAR</button>
						</center>
					</form>
				</center>
			</div>
		</div>
	</div>
</div>