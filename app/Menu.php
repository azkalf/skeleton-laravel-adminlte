<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use Auth;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'menu_text', 'menu_icon', 'menu_parent', 'menu_url', 'menu_order'
    ];

    public function childs() {
    	return $this->hasMany('App\Menu', 'menu_parent', 'id');
    }

    public static function getRoledMenus() {
    	$menu_lists = array();
		$group_menus = Role::select('menu_id')->where('group_id', Auth::User()->group_id)->get();
		$menus = array();
		foreach ($group_menus as $menu) {
			$menus[] = $menu['menu_id'];
		}
		$top_menus = self::whereIn('id',$menus)->where('menu_parent', 0)->oldest('menu_order')->get();
		foreach ($top_menus as $key => $top) {
			$menu_lists[$key]['label'] = $top['menu_text'];
			$menu_lists[$key]['icon'] = $top['menu_icon'];
			$menu_lists[$key]['class'] = $top['menu_class'];
			$menu_lists[$key]['url'] = $top['menu_url'];
			$menu_lists[$key]['items'] = self::getChildMenus($top['id'], $group_menus);
		}
		return $menu_lists;
    }

    public static function getChildMenus($menu_id, $lists) {
    	$menu_lists = array();
    	$menus = self::where('menu_parent',$menu_id)->whereIn('id', $lists)->oldest('menu_order')->get();
    	foreach ($menus as $key => $menu) {
			$menu_lists[$key]['label'] = $menu['menu_text'];
			$menu_lists[$key]['icon'] = $menu['menu_icon'];
			$menu_lists[$key]['class'] = $menu['menu_class'];
			$menu_lists[$key]['url'] = $menu['menu_url'];
			$child = self::where('menu_parent', $menu['id'])->get();
			if (count($child) > 0) {
				$menu_lists[$key]['items'] = self::getChildMenus($menu['id'], $lists);
			}
    	}
    	return $menu_lists;
    }
}
