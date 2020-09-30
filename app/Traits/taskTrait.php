<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Projeto;
use App\Quadro;
use App\TaskFato;
use App\Task;
use App\Kanban;
use App\EquipeUser;
use App\Equipe;
use DB;
use App\Events\NovaTask;
use App\Events\TaskMovida;
use App\Events\MovimentoInvalido;

trait taskTrait
{
	public function salvatarefa(User $user, Request $request){
		$encoding = 'UTF-8'; 
		$quadro = Quadro::where('kanban_id',$request->id)->first();
		$kanban = Kanban::find($request->id);
		$task = new Task();
		$task->task = mb_convert_case($request->tarefa, MB_CASE_UPPER, $encoding);
		$task->descricao =  'TESTE';
		$task->save();

		$tecnico = User::find($request->tecnico);
		$fato = new Taskfato();
		$fato->task()->associate($task->id);
		$fato->quadro()->associate($quadro->id);
		$fato->projeto()->associate($kanban->projeto_id);
		$fato->user()->associate($request->tecnico);
		$fato->save();  
		broadcast(new NovaTask($task,$user))->toOthers();
		event(new NovaTask($task,$user));
		return ['Tarefa criada com sucesso !','success'];
	}
	public function salvaMovimento(User $user, Request $request, TaskFato $task, Task $tarefa){
		$hoje = date('Y-m-d H:i:s');

		//melhorar complexidade !

		if($request->estado != $task->estado){
			if($request->estado == 2){ 
				$date1=date_create($tarefa->custo);
				$date2=date_create($hoje);
				$diff=date_diff($date1,$date2);
				$horas = $diff->format("%h");
				$minutos = $diff->format("%i");
				$tarefa->custo = (($horas*60)+$minutos);	
				$tarefa->save();
			}
			if($request->estado == 3 && $task->estado != 4){ 
				$tarefa->custo = $hoje;
				$tarefa->save();
			}

			// if($request->estado == 4){ 
			// 	$tarefa->custo = $hoje;
			// 	$tarefa->save();
			// }
			// $quadro = Quadro::find($request->quadro);
			// $task->quadro_id = $request->quadro;    
			// $task->estado = $request->estado;
			// $task->save(); 
			
			if($tarefa->task == 'CLOSE-KANBAN' && $request->estado == 2){
				$kanban = Kanban::find($quadro->kanban_id);
				$kanban->status = 2;
				$kanban->save();
			}
		}
		
	}
}