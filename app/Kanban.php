<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kanban extends Model
{
    protected $fillable = [
		'nome',
		'descricao',
		'status',
		'data_ini',
		'data_fim',
		'projeto_id',
	];
	public function projeto(){
		return $this->belongsTo('App\Projeto');
	}
	public function quadros(){
		return $this->hasMany('App\Quadro');
	}
}
