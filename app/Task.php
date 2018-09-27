<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	public function group() {
		return $this->belongsTo(Group::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
