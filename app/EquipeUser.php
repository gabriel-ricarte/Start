<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipeUser extends Model
{
    protected $fillable = [
		'status',
		'permissao',
		'user_id',
		'equipe_id',
	];
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function equipe(){
		return $this->belongsTo('App\Equipe');
	}
}
