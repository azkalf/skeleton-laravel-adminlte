<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
    	'group_name'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public static function groupList() {
    	$groups = self::where('id', '<>', 1)->get();
    	$list = array();
    	foreach ($groups as $group) {
    		$list[$group->id] = $group->group_name;
    	}
    	return $list;
    }
}
