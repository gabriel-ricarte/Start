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
use Cache;
use App\Events\EstadoUser;
use App\Traits\projetoTrait;

class ProjetoController extends Controller
{
    use projetoTrait;
    public function __construct()
    {
         $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function index()
    {
        $user = Auth::user();
        $projetos = Projeto::all();
        $dados = $this->dadosProjetoUser($user);
        //dd($dados);
        $participo = $this->dadosProjetoIntegrante($user);
        $incompleto = Projeto::where('user_id',$user->id)->where('status',0)->with(['kanban'])->get();
        $tarefasA = 0;
        $tarefasF = 0;
        foreach($participo as $t){
            $tarefasA += $t['minhas_tarefas_a'];
            $tarefasF += $t['minhas_tarefas_f'];
        }
        $total = $tarefasF + $tarefasA;
        if($total != 0){
            $total = round(100*($tarefasF/$total));

        }
        $tarefas[] = ['feitas' => $tarefasF, 'pendentes' => $tarefasA,'total'=>$total];
        return view('dashboard.dashboard')
        ->withProjetos($projetos)
        ->withTarefas($tarefas)
        ->withDados($dados)
        ->withIncompleto($incompleto)
        ->withParticipo($participo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('projetos.create')->withUser($user);
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
        $hoje = date('Y-m-d');
        $projeto = new Projeto();
        $projeto->user()->associate($user->id);
        $projeto->po()->associate($request->po_id);
        $projeto->nome = $request->nome;
        $projeto->status = 0;
        //$projeto->po = $request->po_id;
        $projeto->spo = $request->spo;
        $projeto->vertical = $request->vertical;
        $projeto->descricao = $request->descricao;
        $projeto->data_ini = $request->data_ini;
        $projeto->data_fim = $request->data_fim;
        $projeto->info = 'Editável';
        if($request->hasFile('imagem')){
            $image = $request->file('imagem');
            $extension = $image->getClientOriginalExtension();
            $name = $hoje.$image->getClientOriginalName();
            Storage::disk('public')->put($name.'.'.$extension,  File::get($image));
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $projeto->imagem = $name;
        }
        $projeto->save();
        session()->flash('msg','Projeto criado com sucesso !');
        return view('projetos.kanban-create')->withProjeto($projeto);

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

//     public function storeQuadro(Request $request)
//     {
//        $request->validate([
//         'nome' =>'required',
//         'descricao' =>'required|max:255',
//     ]);
//        $user = User::find(Auth::id());
//        if(!$user->status){
//         session()->flash('per','USUÁRIO NÃO AUTORIZADO !');
//         return redirect()->route('inicio');
//     }
//     $hoje = date('Y-m-d');
//     $stage = new Estagio();
//     $stage->projeto()->associate($request->projeto_id);
//     $stage->nome = $request->nome;
//     $stage->status = false;
//     $stage->descricao = $request->descricao;
//     $stage->save();
//     session()->flash('msg','NEW STAGE ADDED TO THE GAME !');
//     return redirect()->route('dashboard');

// }

    public function kanbs(){
        $user = Auth::user();
        $projeto = Projeto::find(1);
        $kanban = Kanban::find(1);
        //$projeto = Projeto::find($kanban->projeto->id);
        $equipe = Equipe::find($projeto->equipe->first->id->id);
        //dd($equipe);
        $membros = $equipe->equipeTecnico;
        return view('kanban.show')->withUser($user)->withProjeto($projeto)->withKanban($kanban)->withMembros($membros);
    }
    public function andamento()
    {
        $user = Auth::user();
        $projetos = $this->andamentoTrait();
        //dd($projetos);
        return view('projetos.em-andamento')
        ->withProjetos($projetos)
        ->withUser($user);
    }

}
