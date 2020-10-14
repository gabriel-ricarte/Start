<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempoTask extends Model
{
    protected $table = 'tempo_task';
    public function task(){
		return $this->belongsTo('App\Task');
	}
}
