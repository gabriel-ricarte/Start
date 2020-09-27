<?php

namespace App\Http\Controllers;

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
use App\Notifications\Contato;
use App\Notifications\Convite;
use App\Events\NovaTask;
use App\Events\TaskMovida;
use App\Traits\verificaTrait;

class TaskController extends Controller
{
    use verificaTrait;
    public function __construct()
    {
         $this->middleware('auth');
    }
    public function newtask(Request $request)
    {
        ///dd($request->all());
        $request->validate([
        'tarefa' => 'required|between:5,250',
        'id' => 'required|exists:quadros,id',
        'tecnico' => 'required|exists:users,id',
        ]);
        //dd($request->all());
        $user = Auth::user();
        $encoding = 'UTF-8'; 
        $quadro = Quadro::where('kanban_id',$request->id)->first();
        $kanban = Kanban::find($request->id);
        $task = new Task();
        $task->task = mb_convert_case($request->tarefa, MB_CASE_UPPER, $encoding);
        $task->descricao =  'TESTE';
        $task->save();

        $tecnico = User::find($request->tecnico);
        //dd($tecnico);asdfasd
        //dd($request->all());
        //\Notification::route('mail', $tecnico->email)->notify(new Convite($request->proposta,$request->texto));
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
    public function movetask(Request $request)
    {
       
        $request->validate([
        'quadro' => 'required|exists:quadros,id',
        'task' => 'required|exists:task_fatos,id',
        'estado' => 'required|integer',
        ]); 
         //dd($request->all());
        $user = Auth::user();
        $task = TaskFato::findOrFail($request->task);
        $tarefa = Task::find($task->task_id);
        $verifica = $this->moveTarefa($user , $task);
        //verifica se movimento é válido
        if(!$verifica[0]){
            return [$verifica[1],$verifica[2]];
        }
        $hoje = date('Y-m-d h:i:s');
        //$onde = 
        if($request->estado == 2){ 
                    $datetime1 = date_create($hoje);
                    $datetime2 = date_create($tarefa->updated_at);
                    $interval = date_diff($datetime1, $datetime2);
                    $tarefa->custo = $interval->format("%R%h horas");
                    $tarefa->save();
            }
            $quadro = Quadro::find($request->quadro);
            $task->quadro_id = $request->quadro;    
            $task->estado = $request->estado;
            $task->save(); 
            
            if($tarefa->task == 'CLOSE-KANBAN' && $request->estado == 2){
                $kanban = Kanban::find($quadro->kanban_id);
                $kanban->status = 2;
                $kanban->save();
            }
            broadcast(new TaskMovida($tarefa,$user))->toOthers();
            event(new TaskMovida($tarefa,$user));
            return ['Movido com sucesso !','success'];
        
        
    }
    public function deltask(Request $request)
    {
        $user = Auth::user();
        $task = TaskFato::findOrFail($request->task);
        $task->estado = 1;    
        $task->save(); 
        $tarefa = Task::find($task->task_id); 
        broadcast(new NovaTask($tarefa,$user))->toOthers();
        return $task;
    }
    public function buscaTask($id){

        //$kanban = Kanban::findOrFail($kanban);
        //$tecnico = Tecnico::findOrFail($id);
        $tasks = [];
        $quadro = Quadro::find($id);
        foreach ($quadro->tasks_ativas as $ta) {
            if($ta->prioridade == 0){
                $cor = 'warning';
            }
            if($ta->prioridade == 1){
                $cor = 'danger';
            }
            $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$ta->prioridade];
        }
        foreach ($quadro->tasks_em_andamento as $ta) {
            if($ta->prioridade == 0){
                $cor = 'warning';
            }
            if($ta->prioridade == 1){
                $cor = 'danger';
            }
            $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$ta->prioridade,'tempo'=>$ta->task->custo];
        }
        foreach ($quadro->tasks_em_revisao as $ta) {
            if($ta->prioridade == 0){
                $cor = 'warning';
            }
            if($ta->prioridade == 1){
                $cor = 'danger';
            }
            $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$ta->prioridade,'revisao'=>$ta->task->descricao];
        }
        foreach ($quadro->tasks_finalizadas as $ta) {
            if($ta->prioridade == 0){
                $cor = 'warning';
            }
            if($ta->prioridade == 1){
                $cor = 'danger';
            }
            $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$ta->prioridade];
        }
        return $tasks;

    }
    public function eventoTask(Request $request){

        $kanban = Kanban::findOrFail($kanban);
        $tecnico = Tecnico::findOrFail($id);
        return $kanban;

    }
    public function manda()
    {
        $user = Auth::user();

        $task = Task::find(9);
        broadcast(new NovaTask($task,$user))->toOthers();
        return 'mandei';
    }
}
