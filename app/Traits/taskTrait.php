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
use App\TempoTask;

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
		switch ((int)$request->estado) {
			//estado de finalizar tarefa
			case 2:
				//so recebe tarefas que estavam sendo feitas 
				if ($task->estado == 3) {
					$tempo = new TempoTask();
					$date1=date_create($tarefa->custo);
					$date2=date_create($hoje);
					$diff=date_diff($date1,$date2);
					$dias = $diff->format("%d");
					$horas = $diff->format("%h");
					$minutos = $diff->format("%i");

					if($dias > 0){
						$tempo->task()->associate($task->id);
						$tempo->tempo = ($dias*24*60)+(($horas*60)+$minutos);
					}else{
						$tempo->task()->associate($task->id);
						$tempo->tempo = (($horas*60)+$minutos);	
					}
					$tempo->save();
					$task->quadro_id = $request->quadro;    
					$task->estado = $request->estado;
					$task->save();
					return [true,'Movimentado com sucesso','success'];

				}
				if ($task->estado == 4) {
					$tempo = TempoTask::findOrFail($task->task->tempo[0]->id);
					$date1=date_create($tarefa->custo);
					$date2=date_create($hoje);
					$diff=date_diff($date1,$date2);
					$dias = $diff->format("%d");
					$horas = $diff->format("%h");
					$minutos = $diff->format("%i");
					if($dias > 0){
						$tempo->tempo = $tempo->tempo + ($dias*24*60)+(($horas*60)+$minutos);
						
					}else{
						
							$tempo->tempo = $tempo->tempo + (($horas*60)+$minutos);	
						
					}
					$task->quadro_id = $request->quadro;    
					$task->estado = $request->estado;
					$task->save();
					return [true,'Movimentado com sucesso','success'];	
					break;
				}
				return [false,'Movimento inválido','danger'];
				
			break;
			//resolver tarefa
			case 3:
			//recebe o estado fazendo
				//verifica a origem
				if($task->estado == 0 || $task->estado == 4){
					$tarefa->custo = $hoje;
					$tarefa->save();
					$quadro = Quadro::find($request->quadro);
					$task->quadro_id = $request->quadro;    
					$task->estado = $request->estado;
					$task->save();
					
				}else{
					return [false,'Movimento inválido','danger'];
				}
				//só deixa receber o estado de quem vem de a fazer

       			return [true,'Tarefa iniciada com sucesso !','success'];
			break;
			case 0:
				if ($task->estado == 2) {
					//revisao
					// mudar o estado e o quadro 
					$task->quadro_id = $request->quadro;    
					$task->estado = 4;
					$task->save();
					return [true,'preparando tarefa para revisão !','revisa',$task->id];
				}
				if($task->estado == 3){
					//pause
					if (isset($task->task->tempo[0])) {
						$tempo = TempoTask::find($task->task->tempo[0]->id);
					}else{
						$tempo = new TempoTask();
						$tempo->task()->associate($task->id);
					}
					
					$date1=date_create($tarefa->custo);
					$date2=date_create($hoje);
					$diff=date_diff($date1,$date2);
					$dias = $diff->format("%d");
					$horas = $diff->format("%h");
					$minutos = $diff->format("%i");
					if($dias > 0){
						if (isset($task->task->tempo[0])) {
							$tempo->tempo =(int)$task->task->tempo[0]->tempo + ($dias*24*60)+(($horas*60)+$minutos);
						}else{
							$tempo->tempo =($dias*24*60)+(($horas*60)+$minutos);
						}
					}else{
						if (isset($task->task->tempo[0])) {
							$tempo->tempo = (int)$task->task->tempo[0]->tempo + (($horas*60)+$minutos);	
						}else{
							$tempo->tempo = ($horas*60)+$minutos;
						}
					}
					$tempo->save();
					$task->quadro_id = $request->quadro;    
					$task->estado = $request->estado;
					$task->save();
					
       			return [true,'Tarefa pausada com sucesso !','success'];
				}
				if($task->estado == 4){
					//pause
					$task->quadro_id = $request->quadro;    
					$task->save();
					
       			return [true,'Tarefa iniciada com sucesso !','success'];
				}
       			return [false,'Erro na movimentação','danger'];
			break;
			default:
			return [false,'Erro ?','danger'];
			break;
		}
		
	}
}