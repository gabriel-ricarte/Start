<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
        protected $fillable = [
		'nome',
		'descricao',
		'status',
		'info',
		'imagem',
		'data_ini',
		'data_fim',
		'user_id',
	];

	public function kanban(){
		return $this->hasMany('App\Kanban');
	}
	public function equipe(){
		return $this->hasMany('App\Equipe');
	}
	public function user(){
		return $this->belongsTo('App\User');
    }
    public function po(){
		return $this->belongsTo('App\User');
	}

}
