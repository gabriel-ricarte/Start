<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
		'nome',
		'status',
		'projeto_id',
	];
	public function projeto(){
		return $this->belongsTo('App\Projeto');
	}
	public function equipeUser(){
		return $this->hasMany('App\EquipeUser');
	}
	public function ativos(){
		return $this->equipeUser()->where('status',0);
	}
}
