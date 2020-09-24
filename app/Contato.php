<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
   	protected $fillable = [
            'user_id', 'tipo','contato',
    ];
    public function usuarios(){
		return $this->belongsTo('App\User');
	}
}
