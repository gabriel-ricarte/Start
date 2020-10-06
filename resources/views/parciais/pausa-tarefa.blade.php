<div class="row" id="revisaTarefaDivFormp" style="display: none">
	<div class="col-xl-4 col-lg-7" >
	</div>
	<div class="col-xl-4 col-lg-7"  >
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary" id="texto">MOTIVO PARA PAUSA DA TAREFA</h6><!-- <span style="float: right"><button class="btn btn-danger btn-sm" onclick="fecha('novaTarefaDiv')"><span class="far fa-times-circle"></span></button></span> -->
			</div>
			<div class="card-body" id="formNovaTarefa">
				<center>
					<h3 style="font-family: 'VT323', monospace;">MOTIVO</h3>
					<form method="post" action="{{ route('revisa.task-motivo') }}"  class="user" id="formRevisaTarefap" >
						@csrf
						<div class="form-group">
							<textarea class="form-control" name="motivo" required="" placeholder="MOTIVO AQUI" autocomplete="off"></textarea>
							<input type="hidden" name="id" value="{{$kanban->id}}">
							<div id="insertTaskIdp"></div>
						</div>
						<center>
							<button type="submit" class="btn btn-success active">CONFIRMAR</button>
						</center>
					</form>
				</center>
			</div>
		</div>
	</div>
</div>