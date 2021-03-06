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
use App\Notifications\ContatoEmail;
use App\Notifications\Convite;
use App\Events\NovaTask;
use App\Events\TaskMovida;
use App\Events\MovimentoInvalido;
use App\Traits\verificaTrait;
use App\Traits\kanbanTrait;
use App\Traits\taskTrait;

class TaskController extends Controller
{
    use verificaTrait;
    use kanbanTrait;
    use taskTrait;

    public function __construct()
    {
         $this->middleware('auth');
    }
    public function newtask(Request $request)
    {
        $request->validate([
        'tarefa' => 'required|between:5,250',
        'id' => 'required|exists:quadros,id',
        'tecnico' => 'required|exists:users,id',
        ]);
        $user = Auth::user();
        //testando retorno de erro 500
        try{
            $this->salvaTarefa($user , $request);
        } catch (Exception $e) {
            return[false,'Erro no processamento dos dados, favor contate o desenvolvedor !'];
        }
        
       return ['Tarefa criada com sucesso !','success'];
    }
    public function movetask(Request $request)
    {
        $request->validate([
        'quadro' => 'required|exists:quadros,id',
        'task' => 'required|exists:task_fatos,id',
        'estado' => 'required|integer',
        ]); 
        //dd($mensagem);

        $user = Auth::user();
        $task = TaskFato::findOrFail($request->task);
        $tarefa = Task::find($task->task_id);
        $verifica = $this->moveTarefa($user , $task, $request);
           // asdf
       // dd($request->all());
       //verifica se movimento é válido
        if($request->quadro == $task->quadro_id || $request->estado == $task->estado ){
            return [' - ', 'light'];
        }
        if(!$verifica[0]){
            event(new MovimentoInvalido($user));
            return [$verifica[1],$verifica[2]];
        }
        $movimento = $this->salvaMovimento($user ,$request ,$task ,$tarefa);
        if(!$movimento[0]){
            event(new MovimentoInvalido($user));
            return [$movimento[1],$movimento[2]];
        }
        broadcast(new TaskMovida($tarefa,$user))->toOthers();
        event(new TaskMovida($tarefa,$user));
        if($movimento[2] == 'revisa'){
         return [$movimento[1],$movimento[2],$movimento[3]];
        }
        //$this->salvaMovimento($user ,$request ,$task ,$tarefa);
       
        return [$movimento[1],$movimento[2]];
    }
    public function deltask(Request $request)
    {
       // dd($request->all());
        $request->validate([
        'task' => 'required|exists:task_fatos,id',
        ]);
        $user = Auth::user();
        $task = TaskFato::findOrFail($request->task);
        $task->estado = 1;    
        $task->save(); 
        $tarefa = Task::find($task->task_id); 
        broadcast(new NovaTask($tarefa,$user))->toOthers();
       return ['Tarefa eliminada com sucesso !','success'];
    }
    public function pausatask(Request $request)
    {
        $request->validate([
        'task' => 'required|exists:task_fatos,id',
        ]);
        $user = Auth::user();
        $task = TaskFato::findOrFail($request->task);
        if($task->estado != 3){
            return [false,'Tarefa ainda não realizada !','danger'];
        }
        $task->estado = 4; 
        $task->save(); 
        $tarefa = Task::find($task->task_id); 
        broadcast(new NovaTask($tarefa,$user))->toOthers();
       return ['Tarefa pausada com sucesso !','success'];
    }
    public function revisatask(Request $request)
    {
        //dd($request->all());
        $request->validate([
        'task' => 'required|exists:task_fatos,id',
        ]);
        $user = Auth::user();
        $task = TaskFato::findOrFail($request->task);
        if($task->estado != 2){
            return [false,'Tarefa ainda não realizada !','danger'];
        }
        $task->estado = 4; 
        $task->quadro_id = $task->quadro_id - 1;  
        $task->save(); 
        $tarefa = Task::find($task->task_id); 
        broadcast(new NovaTask($tarefa,$user))->toOthers();

        return ['Tarefa enviada para revisão com sucesso !','success'];
    }
    public function revisaTaskMotivo(Request $request)
    {
        //dd($request->all());
        $request->validate([
        'task_id' => 'required|exists:task_fatos,id',
        'id' => 'required|exists:kanbans,id',
        'motivo' => 'required|between:5,250',
        ]);
        $user = Auth::user();
        $task = Task::findOrFail($request->task_id);
        $task->descricao = $request->motivo; 
        $task->save(); 
        //broadcast(new NovaTask($tarefa,$user))->toOthers();
        
        return redirect()->route('kanban.show',$request->id);
    }
    public function buscaTask($id){
        $tasks = $this->tarefasKanban($id);
        return $tasks;
    }
    public function buscaK($id){
        $tasks = $this->tarefasTimeline($id);
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
