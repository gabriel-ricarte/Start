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

trait verificaTrait
{
   public function moveTarefa(User $user, TaskFato $task){
   		//verifica se o quadro está em aberto 
   		$quadro = Quadro::find($task->quadro_id);
   		$kanban = $quadro->kanban;
   		if($kanban->status == 2){
   			return [false,'Quadro está finalizado','danger'];
   		}
	    if($task->user_id != $user->id){
	        return [false,'Usuário não tem permissão para mover a tarefa !','danger'];
	    }
       if($task->estado == 2){
           return [false,'Tarefa já finalizada, se precisar de revisão utilize a função correta !','danger'];
       }
	    return [true];
   }
}