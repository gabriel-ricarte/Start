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
use App\Notifications\Convite;
use App\Notifications\Contato;
use App\Traits\verificaTrait;
use App\Http\Controllers\EquipeController;

class PlayerController extends Controller
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
        $hoje = date('Y-m-d H:i:s');
        $encoding = 'UTF-8'; 
        $user = Auth::user();
        $projeto = Projeto::findOrFail($request->projeto);

            //dd('deu certo');

        $request->validate([
        'nome' => 'required|between:5,250',
        'email' => 'required|email|unique:users',
        'projeto' => 'required|exists:projetos,id',
        ]);
        if(!$this->acessaEquipe($user->id,$projeto)){
            return redirect()->back()->withErrors('Usuário não autorizado !');
        }
        $player = new User();
        $player->nome = mb_convert_case($request->nome, MB_CASE_UPPER, $encoding);
        $player->email = $request->email;
        $player->setor = '-';
        $player->password = '0051651651';
        $player->is_admin = 0;
        $player->avatar = 'padrao.png';
        $player->matricula = '-';
        $player->vertical = '-';
        $player->filial = '-';
        $player->status = 'ATIVO';       
        $player->save();


        //adicionando na equipe 
        $equipe = Equipe::findOrFail($projeto->equipe->first->id->id);
       EquipeController::adicionaIntegrante($equipe, $player);
        \Notification::route('mail', $request->email)
            ->notify(new Convite($request->nome,$projeto->nome,$user->nome));
        session()->flash('msg','Adicionado com sucesso !');
        return redirect()->route('equipe.criar');
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
