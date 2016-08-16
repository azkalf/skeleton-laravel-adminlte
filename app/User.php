<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'fullname', 'email', 'password', 'sex', 'photo', 'company_id', 'group_id', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
