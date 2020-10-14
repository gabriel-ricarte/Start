<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
		'tarefa',
		'descricao',
		'custo',
	];
	public function tempo(){
		return $this->hasMany('App\TempoTask');
	}
}
