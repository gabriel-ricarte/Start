<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFato extends Model
{
    protected $fillable = [
		'task_id',
		'user_id',
		'quadro_id',
		'projeto_id',
		//'who_id',
		'estado',
		'prioridade',
	];
	public function quadro(){
		return $this->belongsTo('App\Quadro');
	}
	public function projeto(){
		return $this->belongsTo('App\Projeto');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function task(){
		return $this->belongsTo('App\Task');
	}

}
