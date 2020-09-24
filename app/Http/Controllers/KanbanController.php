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
use App\Traits\kanbanTrait;


class KanbanController extends Controller
{
    use kanbanTrait;
    public function __construct()
    {
         $this->middleware(['auth']);
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
    public function create($id)
    {
        $user = Auth::user();
        $projeto = Projeto::find($id);
        return view('kanban.create')->withUser($user)->withProjeto($projeto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if(!$user->status){
            session()->flash('per','USUÁRIO NÃO AUTORIZADO !');
            return redirect()->route('projeto.index');
        }
        $projeto = Projeto::findOrFail($request->projeto_id);
        if($projeto->user_id != $user->id){
            session()->flash('per','USUÁRIO NÃO AUTORIZADO !');
            return redirect()->route('projeto.index');
        }
        $hoje = date('Y-m-d');
        $kanban = new Kanban();
        $kanban->nome = $request->nome;
        $kanban->descricao = $request->descricao;
        $kanban->status = true;
        $kanban->projeto()->associate($request->projeto_id);
        $kanban->data_ini = $request->data_ini;
        $kanban->data_fim = $request->data_fim;
        $kanban->save();
        //dd($kanban);

        $tipoKanban = $this->tipoKanban($kanban->id,$request->tipo);

       // $integrantes = User::all();

        session()->flash('msg','KANBAN CRIADO COM SUCESSO !');
       // return redirect()->route('equipe.criar');
        return redirect()->route('equipe.criando',$projeto->id)->with('msg','KANBAN CRIADO COM SUCESSO !');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $kanban = Kanban::findOrFail($id);
        $quadros = [];
        $projeto = Projeto::find($kanban->projeto->id);
        $equipe = Equipe::find($projeto->equipe->first->id->id);
        $membros = $equipe->equipeUser;
        foreach($kanban->quadros as $quad){
            $quadros[] = ['quadro' => $quad->id];
        }
       // MINHA PERMISSAO
        $permi = EquipeUser::where('status',0)->where('user_id',$user->id)->where('equipe_id',$equipe->id)->first();
        $mensagem = 'ESTOY VIVO';
        return view('kanban.showvue')->withKanban($kanban)->withMembros($membros)->withProjeto($projeto)->withMensagem($mensagem)->withQuadros($quadros)->withPermi($permi);
        //return view('kanban.show')->withKanban($kanban)->withMembros($membros)->withProjeto($projeto);
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
}