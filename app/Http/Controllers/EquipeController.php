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
use App\Contato;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Notifications\ContatoEmail;
use App\Traits\verificaTrait;

class EquipeController extends Controller
{
    use verificaTrait;
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
        $user = Auth::user();
        $projetos = $user->projeto;
        return view('equipes.index')->withUser($user)->withProjetos($projetos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function criarEquipe()
    {
        $user = Auth::user();
        $projeto = $user->projeto_andando->first;
        if($this->acessaEquipe($user->id,$projeto)){
            $integrantes = User::all();
            $hoje = date('Y-m-d');
            return view('equipes.create')->withProjeto($projeto)->withHoje($hoje)->withIntegrantes($integrantes);
        }else{
            return redirect()->back()->withErrors('Usuário não autorizado !');
        }
        
    }
    public function buscaIntegrantes($id)
    {
        $user = Auth::user();
        $projeto = Projeto::findOrFail($id);
        if($this->acessaEquipe($user->id,$projeto)){
            $equipe = Equipe::find($projeto->equipe->first->id->id);
            $pessoas = [];
            $integrantes = EquipeUser::where('equipe_id',$id)->where('status',0)->get();
            foreach($integrantes as $integrante){
                $pessoas[] = ['id' => $integrante->user->id,'nome' => $integrante->user->nome,'status' => $integrante->status, 'permissao' => $integrante->permissao, 'email' => $integrante->user->email];
            }
            return $pessoas;
        }else{
            return [false,'Usuário não autorizado !'];
        }
        
    }
    public function buscaIntegrantesD($id)
    {
        $user = Auth::user();
        $projeto = Projeto::findOrFail($id);
        $usuarios = User::all();
        $nomes = array();
        if($this->acessaEquipe($user->id,$projeto)){
            $equipe = Equipe::find($projeto->equipe->first->id->id);
            $pessoas = [];
            $integrantes = EquipeUser::where('equipe_id',$id)->where('status',0)->get();
            foreach($integrantes as $integrante){
                $pessoas[] = ['id' => $integrante->user->id];
            }
            foreach($usuarios as $key => $value){

                if($integrantes->contains('user_id',$value->id)){
                    unset($usuarios[$key]);    
                }else{
                    //array_push($nomes,$value->nome);
                    $nomes[] = ['id' => $value->id, 'nome' => $value->nome, 'email' => $value->email]; 
                }
             
            }
            return $nomes;
        }else{
            return [false,'Usuário não autorizado !'];
        }
        
    }

    public function continueEquipe($id)
    {
        $user = Auth::user();
        $projeto = Projeto::findOrFail($id);
        if($this->acessaEquipe($user->id,$projeto)){
           if($projeto->equipe->count() == 0){
            $ids = $projeto->equipe->first->id;
             $integrantes = EquipeUser::where('equipe_id',$ids)->get();
             return view('equipes.criar-equipe')->withProjeto($projeto)->withIntegrantes($integrantes);
        }
        $ids = $projeto->equipe->first->id->id;
        $integrantes = EquipeUser::where('equipe_id',$ids)->where('status',0)->get();
        return view('equipes.criar-equipe')->withProjeto($projeto)->withIntegrantes($integrantes);      
        }else{
             return redirect()->back()->withErrors('Usuário não autorizado !');
        }
       
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
        $projeto = Projeto::find($request->projeto_id);
        if($projeto->equipe->count() == 0 ){
            $team = new Equipe();
            $team->nome = 'SJ CLan '.$projeto->nome;
            $team->status = true;
            $team->projeto()->associate($request->projeto_id);    
            $team->save();
            $projeto->status = 1;
            $projeto->save();
            $pessoa = User::find($request->integrante_id);
            if($pessoa){
                $integrante = new EquipeUser();
                $integrante->status = 0;
                $integrante->permissao =  0;
                $integrante->user()->associate($request->integrante_id);
                $integrante->equipe()->associate($team->id);
                $integrante->save();
            }else{
                return redirect()->back()->withErrors('Usuário inexistente !');
            }
            
        }else{
            $team = Equipe::find($projeto->equipe->first->id->id);
            $repete = EquipeUser::where('equipe_id',$team->id)->where('user_id',$request->integrante_id)->where('status',0)->get();
            if($repete->count() > 0 ){
                return redirect()->back()->withErrors('Integrante já participa da equipe !');
            }
            $escolhido = EquipeUser::where('equipe_id',$team->id)->where('user_id',$request->integrante_id)->where('status',1)->first();
            if($escolhido){
                $escolhido->status = 0;
                $escolhido->save();
                return redirect()->route('equipe.criando',$projeto->id)->with('msg','usuário reintegrado ao projeto');
            }
            $pessoa = User::find($request->integrante_id);
             if($pessoa){
                $integrante = new EquipeUser();
                $integrante->status = 0;
                $integrante->permissao =  0;
                $integrante->user()->associate($request->integrante_id);
                $integrante->equipe()->associate($team->id);
                $integrante->save();
            }else{
                return redirect()->back()->withErrors('Usuário inexistente !');
            }
        }
        return redirect()->route('equipe.criando',$projeto->id);
        
    }
    public static function adicionaIntegrante(Equipe $equipe, User $user){
        $integrante = new EquipeUser();
        $integrante->status = 0;
        $integrante->permissao =  0;
        $integrante->user()->associate($user->id);
        $integrante->equipe()->associate($equipe->id);
        $integrante->save();
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
        $projeto = Projeto::find($id);
        if($projeto->kanban_ativo){
            $kanban = $projeto->kanban_ativo[0];
            session()->flash('msg','Equipe criada com sucesso!');
            return redirect()->route('kanban.show',$kanban->id);
        }else{
            session()->flash('msg','Sem Kanbans ativos no momento !');
            return redirect()->route('projeto.index');
        }
        
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
    public function usersIndex(){
        $user = Auth::user();
        $users = User::all();
        return view('users.index-admin')->withUser($user)->withUsers($users);
    }
    public function perfil(){
        $user = Auth::user();
        $horas = 0;
        $tarefas = $user->tarefas_finalizadas->count();
        foreach($user->tarefas as $tarefa){
            if(isset($tarefa->task->tempo[0])){
                $horas += (int) $tarefa->task->tempo[0]->tempo;
            }
        }
        $tempoHx = gmp_div_q($horas, "60");
        $tempoH = gmp_strval($tempoHx).' Hrs';
        $tempoMx = gmp_div_r($horas, "60");
        $tempoM = gmp_strval($tempoMx).' Mins';
        $tempo = $tempoH.' '.$tempoM;
        ///dd($tempo);
        //dd($user->tarefas);
        return view('users.perfil')->withUser($user)->withTempo($tempo)->withTarefas($tarefas);
    }
    public function inserecontato(Request $request){
        $user = Auth::user();
        //dd($request->all());
        if($request->contatoE){
            $contatoE = new Contato();
            $contatoE->user()->associate($user->id);
            $contatoE->tipo = 'Email';
            $contatoE->contato = $request->contatoE;
            $contatoE->save();
        }
        if($request->contatoC){
            $contatoC = new Contato();
            $contatoC->user()->associate($user->id);
            $contatoC->tipo = 'Celular';
            $contatoC->contato = $request->contatoC;
            $contatoC->save();
        }
        if($request->contatoT){
            $contatoT = new Contato();
            $contatoT->user()->associate($user->id);
            $contatoT->tipo = 'Telefone';
            $contatoT->contato = $request->contatoT;
            $contatoT->save();
        }
        if($request->contatoR){
            $contatoR = new Contato();
            $contatoR->user()->associate($user->id);
            $contatoR->tipo = 'Ramal';
            $contatoR->contato = $request->contatoR;
            $contatoR->save();
        }
        return redirect()->route('perfil')->with('msg','Contato adicionado com sucesso !');
    }
    public function ativaUser($id){
        $user = Auth::user();
        $muda = User::find($id);
        if($muda->status == 0){
           $muda->status = 1; 
       }else{
            $muda->status = 0;
       }
        $muda->save();
        $users = User::all();

        return redirect()->route('admins.index');
    }
}
