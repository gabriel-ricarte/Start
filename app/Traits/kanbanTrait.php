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
}