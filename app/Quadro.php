<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Quadro extends Model
{
	//public $user = Auth::user();
    protected $fillable = [
		'nome',
		'descricao',
		'status',
		'posicao',
		'kanban_id',
	];
	public function kanban(){
		return $this->belongsTo('App\Kanban');
	}
	public function tasks(){
		return $this->hasMany('App\TaskFato');
	}

    // results in a "problem", se examples below
    public function tasks_ativas() {
        return $this->tasks()->where('estado','=', 0);
    }
    public function tasks_finalizadas() {
        return $this->tasks()->where('estado','=', 2);
    }
    public function minhas_tasks_ativas($id) {
        return $this->tasks()->where('estado','=', 0)->where('user_id',$id);
    }
    public function minhas_tasks_finalizadas($id) {
        return $this->tasks()->where('estado','=', 2)->where('user_id',$id);
    }
}
