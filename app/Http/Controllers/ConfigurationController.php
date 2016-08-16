<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use App\Company;
use App\Menu;
use App\Role;
use App\User;
use Form;
use Validator;

class ConfigurationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function group() {
		$groups = Group::where('id', '<>', 1)->paginate(10);
		return view('config.group', compact('groups'));
	}

	public function destroyGroup($id) {
		if ($id > 2) {
			$group = Group::find($id);
			$group->delete();
			session()->flash('success', 'Group '.$group->group_name.' has successfully deleted.');
		} else {
			session()->flash('error', 'You can not destroy this default Group.');
		}
		return redirect('group');
	}

	public function createGroup() {
		$group = new Group;
		$menuList = array();
		$menuTree = $this->treeView($menuList);
		return view('config.createGroup', compact(['menuTree', 'group']));
	}

	public function storeGroup(Request $request) {
		$group = new Group;
		$validator = Validator::make($request->all(), [
            'group_name' => 'required|max:255|unique:groups',
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('group/create')
                            ->withErrors($validator)
                            ->withInput();
        }
        $group->group_name = $request['group_name'];
		$group->save();
		if (isset($request['menu'])) {
			foreach ($request['menu'] as $menu) {
				$role = new Role;
				$role->group_id = $id;
				$role->menu_id = $menu;
				$role->save();
			}
		}
		session()->flash('success', 'Group has successfully created.');
		return redirect('group');
	}

	public function editGroup($id) {
		$group = Group::find($id);
		$menuList = $this->getMenuListGroup($id);
		$menuTree = $this->treeView($menuList);
		return view('config.editGroup', compact(['group','menuTree']));
	}

	public function updateGroup(Request $request, $id) {
		$group = Group::find($id);

		$validator = Validator::make($request->all(), [
            'group_name' => 'required|max:255',
        ]);

        if ($request['group_name'] != $group->group_name) {
            if (Group::where('group_name', $request['group_name'])) {
                $validator->after(function($validator) {
                    $validator->errors()->add('group_name', 'These Group Name has already been taken.');
                });
            }
        }

        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('group/'.$id.'/edit')
                            ->withErrors($validator)
                            ->withInput();
        }

		$group->group_name = $request['group_name'];
		$group->save();
		Role::where('group_id', $id)->delete();
		if (isset($request['menu'])) {
			foreach ($request['menu'] as $menu) {
				$role = new Role;
				$role->group_id = $id;
				$role->menu_id = $menu;
				$role->save();
			}
		}
		session()->flash('success', 'Group has successfully updated.');
		return redirect('group');
	}

	protected function getMenuListGroup($id) {
		$menuList = Role::select('menu_id')->where('group_id', $id)->get();
		$list = array();
		foreach ($menuList as $menu) {
			$list[] = $menu['menu_id'];
		}
		return $list;
	}

	protected function treeView($menuList){
        $menus = Menu::where('menu_parent', 0)->get();
        $tree='<ul id="menu-list" class="filetree">';
        foreach ($menus as $menu) {
        	$tree .= '<li class="treeview"><span>'.Form::checkBox('menu['.$menu->id.']', $menu->id, in_array($menu->id, $menuList) ? true : false).'</span> &nbsp;'.$menu->menu_text;
             if(count($menu->childs)) {
                $tree .= $this->childView($menu, $menuList);
            }
        }
        $tree .='<ul>';
        return $tree;
    }

    protected function childView($menu, $menuList){                 
        $html ='<ul>';
        foreach ($menu->childs as $child) {
            if(count($child->childs)){
            	$html .= '<li class="treeview"><span>'.Form::checkBox('menu['.$child->id.']', $child->id, in_array($child->id, $menuList) ? true : false).'</span> &nbsp;'.$child->menu_text;
                $html.= $this->childView($child, $menuList);
            } else {
                $html .= '<li class="treeview"><span>'.Form::checkBox('menu['.$child->id.']', $child->id, in_array($child->id, $menuList) ? true : false).'</span> &nbsp;'.$child->menu_text.'</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }

	protected function getMenuList() {
		$menus = Menu::oldest('menu_order')->where('menu_parent', 0)->get();
		$list = array();
		foreach ($menus as $menu) {
			$list[$menu->id] = $menu->menu_text;
			$child = $this->getChildMenu($menu->id);
			if ($child) {
				foreach ($child as $key => $value) {
					array_push($list, $key=$value);
				}
			}
		}
		return $list;
	}

	protected function getChildMenu($id) {
		$menus = Menu::oldest('menu_order')->where('menu_parent', $id)->get();
		$list = array();
		foreach ($menus as $menu) {
			$list[$menu->id] = $menu->menu_text;
			$child = $this->getChildMenu($menu->id);
			if ($child) {
				foreach ($child as $key => $value) {
					array_push($list, $key=$value);
				}
			}
		}
		return $list;
	}

	public function menu() {
		$menuList = array();
		$menuTree = $this->treeViewMenu();
		return view('config.menu', compact('menuTree'));
	}

	public function listMenu(Request $request) {
		$id = $request->get('id');
		$html = '';
		$menu = Menu::find($id)->toArray();
		if ($menu) {
			$menu_parent = !empty($menu['menu_parent']) ? Menu::find($menu['menu_parent'])->menu_text : '';
			$html .= '<tr><td><strong>Menu Text</strong></td><td>'.$menu['menu_text'].'</td></tr>';
			$html .= '<tr><td><strong>Menu Icon</strong></td><td><i class="fa '.$menu['menu_icon'].'"></i> ('.$menu['menu_icon'].')</td></tr>';
			$html .= '<tr><td><strong>Menu Parent</strong></td><td>'.$menu_parent.'</td></tr>';
			$html .= '<tr><td><strong>Menu Url</strong></td><td>'.$menu['menu_url'].'</td></tr>';
			$html .= '<tr><td><strong>Menu Classname</strong></td><td>'.$menu['menu_classname'].'</td></tr>';
			$html .= '<tr><td><strong>Menu Order</strong></td><td>'.$menu['menu_order'].'</td></tr>';
			$html .= '<tr><td><a href="'.url('menu/'.$id.'/edit').'" class="pull-right update" data-original-title="Update" data-toggle="tooltip"><i class="glyphicon glyphicon-pencil"></i></a></td>';
			$html .= '<td>'.Form::open(['method'=>'DELETE', 'url'=>'/menu/'.$id]).'<a onclick="delMenu(this);" class="delete" data-id="'.$id.'" data-original-title="Delete" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></a>'.Form::close().'</td></tr>';
		}
		echo $html;
	}

	public function destroyMenu($id) {
		if ($id > 5) {
			$menu = Menu::find($id);
			$menu->delete();
			session()->flash('success', 'Menu '.$menu->menu_name.' has successfully deleted.');
		} else {
			session()->flash('error', 'This is default Menu. You cannot destroy it.');
		}
		return redirect('menu');
	}

	public function createMenu() {
		$menu = new Menu;
		$menuList = $this->getMenuList();
		return view('config.createMenu', compact(['menuList', 'menu']));
	}

	public function storeMenu(Request $request) {
		$menu = new Menu;
		$validator = Validator::make($request->all(), [
            'menu_text' => 'required|max:255',
            'menu_icon' => 'required',
            'menu_url' => 'required',
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('menu/create')
                            ->withErrors($validator)
                            ->withInput();
        }
		$menu->fill($request->all());
		$menu->save();
		Role::create([
			'group_id' => 1,
			'menu_id' => $menu->id,
		]);
		session()->flash('success', 'Menu has successfully created.');
		return redirect('menu');
	}

	public function editMenu($id) {
		$menu = Menu::find($id);
		$menuList = $this->getMenuList();
		return view('config.editMenu', compact(['menuList', 'menu']));
	}

	public function updateMenu(Request $request, $id) {
		$menu = Menu::find($id);

		$validator = Validator::make($request->all(), [
            'menu_text' => 'required|max:255',
            'menu_icon' => 'required',
            'menu_url' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('menu/'.$id.'/edit')
                            ->withErrors($validator)
                            ->withInput();
        }

        $menu->fill($request->all());
		$menu->save();
		session()->flash('success', 'Menu has successfully updated.');
		return redirect('menu');
	}

	protected function treeViewMenu(){
        $menus = Menu::where('menu_parent', 0)->get();
        $tree='<ul id="menu-list" class="filetree">';
        foreach ($menus as $menu) {
        	$tree .= '<li class="treeview">&nbsp;<a data-id="'.$menu->id.'" onclick="changeGrid(this);">'.$menu->menu_text.'</a>';
             if(count($menu->childs)) {
                $tree .= $this->childViewMenu($menu);
            }
        }
        $tree .='<ul>';
        return $tree;
    }

    protected function childViewMenu($menu){                 
        $tree ='<ul>';
        foreach ($menu->childs as $child) {
            if(count($child->childs)){
            	$tree .= '<li class="treeview">&nbsp;<a data-id="'.$child->id.'" onclick="changeGrid(this);">'.$child->menu_text.'</a>';
                $tree.= $this->childViewMenu($child, $menuList);
            } else {
                $tree .= '<li class="treeview">&nbsp;<a data-id="'.$child->id.'" onclick="changeGrid(this);">'.$child->menu_text.'</a></li>';
            }
        }
        $tree .= '</ul>';
        return $tree;
    }

    public function generateMenu() {
    	echo $this->treeViewMenu();
    }

	public function user() {
		$users = User::where('id', '<>', 1)->paginate(10);
		return view('config.user', compact('users'));
	}

	public function company() {
		$companies = Company::paginate(10);
		return view('config.companyAdmin', compact('companies'));
	}

	public function destroyUser($id) {
		$user = User::find($id);
		$user->delete();
		session()->flash('success', 'User '.$user->name.' has successfully deleted.');
		return redirect('user');
	}

	public function createUser() {
		$user = new User;
		return view('config.createUser', compact('user'));
	}

	public function storeUser(Request $request) {
		$user = new User;
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:users|alpha_dash',
            'fullname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'sex' => 'required',
            'password' => 'required|min:6|confirmed',
            'company_id' => 'required',
            'group_id' => 'required',
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'There is something wrong!');
            return redirect('user/create')
                            ->withErrors($validator)
                            ->withInput();
        }
		$user->create($request->all());
		session()->flash('success', 'user has successfully created.');
		return redirect('user');
	}
}
