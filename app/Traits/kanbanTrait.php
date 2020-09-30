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
   $quadro = new Quadro();
   $quadro->nome = 'A FAZER';
   $quadro->descricao = 'Tarefas a Fazer';
   $quadro->status = 0;
   $quadro->posicao = 1;
   $quadro->kanban()->associate($id); 
   $quadro->save();
   $quadro = new Quadro();
   $quadro->nome = 'FAZENDO';
   $quadro->descricao = 'Tarefas em Andamento';
   $quadro->status = 0;
   $quadro->posicao = 2;
   $quadro->kanban()->associate($id); 
   $quadro->save();
   $quadro = new Quadro();
   $quadro->nome = 'FEITO';
   $quadro->descricao = 'Tarefas Completas';
   $quadro->status = 0;
   $quadro->posicao = 3;
   $quadro->kanban()->associate($id); 
   $quadro->save();
   return $quadro;
 }
 if($tipo == 4){
   $quadro = new Quadro();
   $quadro->nome = 'A FAZER';
   $quadro->descricao = 'Tarefas a Fazer';
   $quadro->status = 0;
   $quadro->posicao = 1;
   $quadro->kanban()->associate($id); 
   $quadro->save();
   $quadro = new Quadro();
   $quadro->nome = 'FAZENDO';
   $quadro->descricao = 'Tarefas em Andamento';
   $quadro->status = 0;
   $quadro->posicao = 2;
   $quadro->kanban()->associate($id); 
   $quadro->save();
   $quadro = new Quadro();
   $quadro->nome = 'EM TESTE';
   $quadro->descricao = 'Tarefas Sendo Testadas';
   $quadro->status = 0;
   $quadro->posicao = 3;
   $quadro->kanban()->associate($id); 
   $quadro->save();
   $quadro = new Quadro();
   $quadro->nome = 'FEITO';
   $quadro->descricao = 'Tarefas Completas';
   $quadro->status = 0;
   $quadro->posicao = 4;
   $quadro->kanban()->associate($id); 
   $quadro->save();
   return $quadro;
 }

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

    $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'tempo'=>'Resolvido em '.$hrs.$mins];
  }
  return $tasks;
}
public function tarefasTimeline($id){
  $tasks = [];
  $quadros = Quadro::where('kanban_id',$id)->get();
  if(!$quadros){
    return [false,'Kanban não encontrado !'];
  }
  foreach($quadros as $quadro){
    foreach ($quadro->tasks_ativas as $ta) {
      if($ta->prioridade == 0){
        $cor = 'card bg-warning';
      }
      if($ta->prioridade == 1){
        $cor = 'card bg-danger';
      }
      $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor];
    }
    foreach ($quadro->tasks_em_andamento as $ta) {
      if($ta->prioridade == 0){
        $cor = 'card bg-warning';
      }
      if($ta->prioridade == 1){
        $cor = 'card bg-danger';
      }
      $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'tempo'=>$ta->task->custo];
    }
    foreach ($quadro->tasks_em_revisao as $ta) {
      if($ta->prioridade == 0){
        $cor = 'card  bg-warning';
      }
      if($ta->prioridade == 1){
        $cor = 'card bg-danger';
      }
      $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'revisao'=>$ta->task->descricao];
    }
    foreach ($quadro->tasks_finalizadas as $ta) {
      if($ta->prioridade == 0){
        $cor = 'card bg-light';
      }
      $tasks[] = ['id'=>$ta->id , 'task' => $ta->task->task,'dono'=>$ta->user->nome,'prioridade' =>$cor,'tempo'=>$ta->task->custo];
    }
  }

  return $tasks;
}
}