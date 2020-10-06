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
   public function moveTarefa(User $user, TaskFato $task, Request $request){
   		//verifica se o quadro está em aberto 
   		$quadro = Quadro::find($task->quadro_id);
   		$kanban = $quadro->kanban;
   		if($kanban->status == 2 ){
   			return [false,'Quadro está finalizado','danger'];
   		}
	    if($task->user_id != $user->id){
	        return [false,'Usuário não tem permissão para mover a tarefa !','danger'];
	    }
      //dd($request);
       if($task->estado == 2 && $request->estado =! 2){
           return [false,'Tarefa já finalizada, se precisar de revisão utilize a função correta !','danger'];
       }
	    return [true];
   }
   public function acessaEquipe($id, Projeto $projeto){
    $val = 0;
      if($id != $projeto->user_id){
        $val++;
      }
      if($id != $projeto->po_id){
        $val++;
      }if($val == 2){
        return false;
      }else{
        return true;
      }
      
   }
}