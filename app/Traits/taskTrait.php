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
}