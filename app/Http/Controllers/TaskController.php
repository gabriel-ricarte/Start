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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Notifications\Contato;
use App\Notifications\Convite;
use App\Events\NovaTask;
use App\Events\TaskMovida;

class TaskController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function newtask(Request $request)
    {
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
        //return redirect()->route('mandei');
        return $task;
    }
    public function movetask(Request $request)
    {
        $user = Auth::user();
        $task = TaskFato::findOrFail($request->task);
        $tarefa = Task::find($task->task_id);
        if($task->user_id != $user->id){
            $quadro = Quadro::find($request->quadro);
            return redirect()->route('kanban.show',$quadro->kanban_id)->withErrors('Usuário não tem permissão para mover a tarefa selecionada !');
        }else{
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
            return $task;
        }
        
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
            $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome];
        }
        foreach ($quadro->tasks_finalizadas as $ta) {
            $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome];
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
