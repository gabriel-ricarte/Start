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

trait kanbanTrait
{
 public function tipoKanban($id,$tipo){

  if($tipo == 3){
  $this->quadroCreate('A FAZER','Tarefas a Fazer',0 , 1 , $id);
  $this->quadroCreate('FAZENDO','Tarefas em Andamento',0 , 2 , $id);
  $this->quadroCreate('FEITO','Tarefas Completas',0 , 3 , $id);
   return ['true','sucesso !'];
 }
 if($tipo == 4){
    $this->quadroCreate('A FAZER','Tarefas a Fazer',0 , 1 , $id);
    $this->quadroCreate('FAZENDO','Tarefas em Andamento',0 , 2 , $id);
    $this->quadroCreate('TESTE','Tarefas em Teste',0 , 3 , $id);
    $this->quadroCreate('FEITO','Tarefas Completas',0 , 4 , $id);
   return $quadro;
 }

}

public function quadroCreate($nome,$desc,$status,$pos,$id){
   $quadro = new Quadro();
   $quadro->nome = $nome;
   $quadro->descricao = $desc;
   $quadro->status = $status;
   $quadro->posicao = $pos;
   $quadro->kanban()->associate($id); 
   $quadro->save();
}

public function tarefasKanban($id){

  $tasks = [];
  $quadro = Quadro::findOrFail($id);
  $hoje = date('Y-m-d H:i:s');
  foreach ($quadro->tasks_ativas as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-warning';
    }
    if($ta->prioridade == 1){
      $cor = 'card pan dragg qitem bg-danger';
    }
    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'tempo' => $ta->task->custo];
  }
  foreach ($quadro->tasks_em_andamento as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-primary blink';
    }
    if($ta->prioridade == 1){
      $cor = 'card pan dragg qitem bg-danger';
    }
    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'revisao'=>$ta->task->descricao,'tempo'=>$ta->task->custo];
  }
  foreach ($quadro->tasks_em_revisao as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-primary blink';
    }
    if($ta->prioridade == 1){
      $cor = 'card pan dragg qitem bg-danger';
    }
    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'revisao'=>$ta->task->descricao,'tempo'=>$hoje];
  }
  foreach ($quadro->tasks_finalizadas as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-light';
    }

    if($ta->task->custo == 0){
      $hrs = '00:';
      $mins = '00';
      $tempo = $hrs.$mins;
    }else{

      if($ta->task->custo > 60 && $ta->task->custo <= 1440){
        $tempoHx = gmp_div_q($ta->task->custo, "60");
        $tempoH = gmp_strval($tempoHx).':';
        $tempoMx = gmp_div_r($ta->task->custo, "60");
        $tempoM = gmp_strval($tempoMx).' Hrs';

        $tempo = $tempoH.$tempoM;
      }if($ta->task->custo <= 60){
        $hrs = '00:';
        $mins = $ta->task->custo.' Hrs';
        $tempo = $hrs.$mins;
      }
      if($ta->task->custo > 1440){
        $tempoDx = gmp_div_q($ta->task->custo, "1440");
        $tempoD = gmp_strval($tempoDx);

        $tempoHx = $ta->task->custo - ($tempoD*1440);
        $tempoHx = gmp_div_q($tempoHx, "60");
        $tempoH = gmp_strval($tempoHx);

        $tempo = $tempoD.' Dia(s) '.$tempoH.' Hrs';
      }
    }

    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'tempo'=>'Resolvido em '.$tempo];
  }
  return $tasks;
}
public function tarefasTimeline($id){
  $tasks = [];
  $kanban = Kanban::findOrFail($id);
  if(!$kanban){
    return [false,'Kanban não encontrado !'];
  }
  $hoje = date('Y-m-d H:i:s');

 foreach($kanban->quadros as $quadro){
      foreach ($quadro->tasks_ativas as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-warning';
    }
    if($ta->prioridade == 1){
      $cor = 'card pan dragg qitem bg-danger';
    }
    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'tempo' => $ta->task->custo,'tipo' =>0];
  }

  foreach ($quadro->tasks_em_andamento as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-primary blink';
    }
    if($ta->prioridade == 1){
      $cor = 'card pan dragg qitem bg-danger';
    }
    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'revisao'=>$ta->task->descricao,'tempo'=>$ta->task->custo,'tipo' =>1];
  }
  foreach ($quadro->tasks_em_revisao as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-primary blink';
    }
    if($ta->prioridade == 1){
      $cor = 'card pan dragg qitem bg-danger';
    }
    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'revisao'=>$ta->task->descricao,'tempo'=>$ta->updated_at,'tipo' =>2];
  }
  foreach ($quadro->tasks_finalizadas as $ta) {
    if($ta->prioridade == 0){
      $cor = 'card pan dragg qitem bg-light';
    }
    if($ta->task->custo == 0){
      $hrs = '00:';
      $mins = '00';
    }else{
      if($ta->task->custo > 60){
        $div1 = gmp_div_q($ta->task->custo, "60");
        $hrs = gmp_strval($div1).':';
        $div = gmp_div_r($ta->task->custo, "60");
        $mins = gmp_strval($div).' Hrs';
      } else{
        $hrs = '00:';
        $mins = $ta->task->custo.' Hrs';
      }
    }

    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'tempo'=>'Resolvido em '.$hrs.$mins,'tipo' =>3];
  }
 }
  
  
   return $tasks;
  }
}