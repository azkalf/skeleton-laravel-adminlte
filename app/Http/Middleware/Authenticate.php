<?php

namespace App\Http\Middleware;

use Closure;
use App\Menu;
use App\Role;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        
        if (!$this->allowedUrl($request)) {
            return abort(503);
        }

        return $next($request);
    }

    protected function allowedUrl($request) {
        $roledMenu = Role::where('group_id', Auth::User()->group_id)->pluck('menu_id')->toArray();
        $menus = Menu::whereIn('id', $roledMenu)->get();
        $menuUrls = array('home', 'profile', 'company', 'menuAjax', 'menuDel', 'menuGen');
        foreach ($menus as $menu) {
            $menuUrls[] = $menu->menu_url;
        }
        $path = explode('/', $request->path());
        return (boolean)in_array($path[0], $menuUrls);
    }
}
