<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['name'];

    public function users() {
    	return $this->belongsTo(User::class);
    }
}
