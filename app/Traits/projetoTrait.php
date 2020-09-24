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
use App\Equipe;
use App\EquipeUser;

trait projetoTrait
{
   public function dadosProjetoUser(User $user){

    $projetos = Projeto::where('user_id',$user->id)->where('status',1)->with(['kanban'])->get();
    $retorno = [];
    foreach($projetos as $projeto){
        $tarefasF = 0;
        $tarefasA = 0;
        $total = 0;
        $minhasTarefasF = 0;
        $minhasTarefasA  = 0;
        foreach($projeto->kanban as $kanban) {
            foreach($kanban->quadros as $quadro){
                $minhasTarefasA+=$quadro->minhas_tasks_ativas($user->id)->count();
                $minhasTarefasF+=$quadro->minhas_tasks_finalizadas($user->id)->count();
                $tarefasA+=$quadro->tasks_ativas->count();
                $tarefasF+=$quadro->tasks_finalizadas->count();
            }
            $kan[] = ['kanban_nome'=>$kanban->nome,'kanban_id'=>$kanban->id,'kanban_status' => $kanban->status,'concluido'=>date('d/m/Y', strtotime($kanban->updated_at))];
        }
        $total =  $tarefasA + $tarefasF;
        if($total > 0 ){
          $total = round(100*($tarefasF/$total));
        }
        $retorno[] = ['projeto_id'=>$projeto->id,'projeto_nome'=>$projeto->nome,'kanban'=>$kan,'tasks_completas' => $tarefasF,'tasks_fazer'=>$tarefasA,'minhas_tarefas_f'=>$minhasTarefasF,'minhas_tarefas_a'=>$minhasTarefasA,'percentagem'=>$total];
        $kan = null;
    }
    return $retorno;

    }
    public function dadosProjetoIntegrante(User $user){

        $projetos = Projeto::where('id',0)->get();
        $andando = EquipeUser::where('user_id',$user->id)->where('status',0)->get();
        foreach($andando as $anda){
            $equipe = Equipe::find($anda->equipe_id);
            $projeto = Projeto::where('id',$equipe->projeto->id)->get();
            $projetos = $projeto->merge($projetos);
        }
        $retorno = [];
        foreach($projetos as $projeto){
            $tarefasF = 0;
            $tarefasA = 0;
            $minhasTarefasF = 0;
            $minhasTarefasA  = 0;
            foreach($projeto->kanban as $kanban) {
                foreach($kanban->quadros as $quadro){
                    $minhasTarefasA+=$quadro->minhas_tasks_ativas($user->id)->count();
                    $minhasTarefasF+=$quadro->minhas_tasks_finalizadas($user->id)->count();
                    $tarefasA+=$quadro->tasks_ativas->count();
                    $tarefasF+=$quadro->tasks_finalizadas->count();
                }

                $kan[] = ['kanban_nome'=>$kanban->nome,'kanban_id'=>$kanban->id,'kanban_status' => $kanban->status,'concluido'=>date('d/m/Y', strtotime($kanban->updated_at))];
            }
            $total =  $minhasTarefasA + $minhasTarefasF;
            if($total > 0 ){
                $total = round(100*($minhasTarefasF/$total));
            }
            $retorno[] = ['projeto_id'=>$projeto->id,'projeto_nome'=>$projeto->nome,'kanban'=>$kan,'tasks_completas' => $tarefasF,'tasks_fazer'=>$tarefasA,'minhas_tarefas_f'=>$minhasTarefasF,'minhas_tarefas_a'=>$minhasTarefasA,'percentagem'=>$total];
            $kan = null;
        }
        return $retorno;

        }
    public function andamentoTrait()
    {
        $projetos = Projeto::where('status',1)->with(['kanban'])->get();
        $hoje = date('Y-m-d');
        foreach($projetos as $projeto){
            $tarefasF = 0;
            $tarefasA = 0;

            foreach($projeto->kanban as $kanban) {
                $bF = 0;
                $bA = 0;
                foreach($kanban->quadros as $quadro){
                    $tarefasA+=$quadro->tasks_ativas->count();
                    $tarefasF+=$quadro->tasks_finalizadas->count();
                    $bA+=$quadro->tasks_ativas->count();
                    $bF+=$quadro->tasks_finalizadas->count();
                }
                $ands =  $bA + $bF;
                if($ands > 0 ){
                    $ands = round(100*($bF/$ands));
                }
                if($kanban->status == 2){
                    // $date1=date_create("2013-03-15");
                    // $date2=date_create("2013-12-12");
                    // $diff=date_diff($date1,$date2);
                    // $diff->format("%R%a dias");
                    $datetime1 = date_create($kanban->data_fim);
                    $datetime2 = date_create($kanban->updated_at);
                    $interval = date_diff($datetime1, $datetime2);
                    $dif = $interval->format('%d');
                }else{
                    $datetime1 = date_create($hoje);
                    $datetime2 = date_create($kanban->data_fim);
                    $interval = date_diff($datetime1, $datetime2);
                    //$dif = $interval->format('%d');
                }
                
                $kan[] = ['kanban_nome'=>$kanban->nome,'kanban_id'=>$kanban->id,'kanban_andamento' => $ands,'data_ini'=>date('d/m/Y', strtotime($kanban->data_ini)),'data_fim' => date('d/m/Y', strtotime($kanban->data_fim)),'tarefas_pendentes' => $bA,'tarefas_completas' => $bF, 'concluido'=>date('d/m/Y', strtotime($kanban->updated_at)),'status' => $kanban->status,'percentagem'=>$ands,'descricao' =>  $kanban->descricao,'dif'=>$interval->format("%R%a dias")];
            }

            $total =  $tarefasA + $tarefasF;
            if($total > 0 ){
                $total = round(100*($tarefasF/$total));
            }
            $retorno[] = ['projeto_id'=>$projeto->id,'projeto_nome'=>$projeto->nome,'kanban'=>$kan,'tasks_completas' => $tarefasF,'tasks_fazer'=>$tarefasA,'percentagem'=>$total,'imagem' => $projeto->imagem];
            $kan = null;
        }
        return $retorno;
    }
}
