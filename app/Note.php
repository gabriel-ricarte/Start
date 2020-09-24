<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
		'nota',
		'status',
		'user_id',
		'kanban_id',
	];
}
