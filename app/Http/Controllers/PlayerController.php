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

class PlayerController extends Controller
{
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
    // public function store(Request $request)
    // {
    //     $hoje = date('Y-m-d-H-i-s');
    //     $encoding = 'UTF-8'; 
    //     $player = new Tecnico();
    //     $player->nome = mb_convert_case($request->nome, MB_CASE_UPPER, $encoding);
    //     $player->email = $request->email;
    //     $player->contato = $request->contato;
    //     $player->setor = mb_convert_case($request->setor, MB_CASE_UPPER, $encoding);
    //     $player->hash = $hoje.substr($request->email,0,4);
    //     $player->save();  
    //     session()->flash('msg','Adicionado com sucesso !');
    // }
    public function newPlayer(Request $request)
    {
        $hoje = date('Y-m-d-H-i-s');
        $encoding = 'UTF-8'; 
        $player = new Tecnico();
        $player->nome = mb_convert_case($request->nome, MB_CASE_UPPER, $encoding);
        $player->email = $request->email;
        $player->contato = $request->contato;
        $player->setor = mb_convert_case($request->setor, MB_CASE_UPPER, $encoding);
        $player->hash = $hoje.substr($request->email,0,4);
        $player->save();  
        $tecnicos = Tecnico::all();
        return $tecnicos;
        session()->flash('msg','Adicionado com sucesso !');
    }
    public function movePlayer(Request $request)
    {
        $player = Tecnico::find($request->tecnico_id);
        $player->escolhido = 1;
        $player->save();  
        session()->flash('msg','Escolhido para o time!');
    }
    public function removePlayer(Request $request)
    {
        $user = Auth::user();
        $player = EquipeUser::where('user_id',$request->user_id)->where('equipe_id',$request->equipe_id)->first();
        $player->status = 1;
        $player->save();  
        return redirect()->route('equipe.index')->with('msg','Operação realizada com sucesso !');
        session()->flash('msg','Escolhido para o time!');
    }
    public function alterPlayer(Request $request)
    {
        $user = Auth::user();
        $player = EquipeUser::where('user_id',$request->user_id)->where('equipe_id',$request->equipe_id)->first();
        $player->permissao = $request->permissao;
        $player->save();  
        return redirect()->route('equipe.index')->with('msg','Operação realizada com sucesso !');
        session()->flash('msg','Escolhido para o time!');
    }
    public function storeTeamAndSteps(Request $request)
    {
        $user = Auth::user();
        if(!$user->status){
            session()->flash('per','USUÁRIO NÃO AUTORIZADO !');
            return redirect()->route('projeto.index');
        }
        $hoje = date('Y-m-d-H-i-s');
        $projeto = Projeto::findOrFail($request->projeto_id);
        $projeto->status = 1;
        $projeto->save();
        $team = new Equipe();
        $team->nome = 'SJ CLan';
        $team->status = true;
        $team->projeto()->associate($request->projeto_id);    
        $team->save();

        $integrantes = $request->integrantes;
        $permissao = $request->permis;
        $count = 0;
        foreach($integrantes as $r)
        { 

            $player = Tecnico::find($r);
            $player->escolhido = 0;
            $player->save();    

            $jovem = new EquipeTecnico();
            $jovem->status = 0;
            $jovem->permissao =  $permissao[$count];
            $jovem->tecnico()->associate($r);
            $jovem->equipe()->associate($team->id);
            $jovem->save();
            $count++;
        }
        $kanban = $projeto->kanban;
        $kanban = $kanban[0];
        //dd($kanban);
        $equipe = Equipe::find($projeto->equipe->first->id->id);
        $membros = $equipe->equipeTecnico;
        session()->flash('msg','Equipe criada com sucesso!');
        return redirect()->route('kanban.show',$kanban->id);
        //return view('kanban.show')->withProjeto($projeto)->withKanban($kanban)->withMembros($membros);    

}
    public function buscaIntegrante(Request $request)
    {
        $user = Auth::user();
        $clientesN = User::where('nome','like','%'.$request->dado.'%')->get();
        $clientesE = User::where('email','like','%'.$request->dado.'%')->get();
        $clientes = $clientesN->merge($clientesE);
        $clientes = $clientes->unique('id');
        return $clientes->toArray();
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
}
