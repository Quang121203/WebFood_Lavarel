<?php

namespace App\Http\Middleware;

use App\Business\MenuBusiness;
use App\Models\RoleMenu;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Author
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public static function checkPermission()
    {
        $route = Route::currentRouteName();
        $parts = explode('.', $route);
        $route = '/' . $parts[0];
        $role = Auth()->user()->role_id;
        $menus = RoleMenu::where('role_id', $role)->get();
        $menu_link = [];
        foreach ($menus as $menu) {
            $link = (MenuBusiness::getById($menu['menu_id']))->link;
            $menu_link[] = $link;
        }

        if (in_array($route, $menu_link)) {
            return true;
        } else {
            return false;
        }
    }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (self::checkPermission())
                return $next($request);
            else
                abort(403, "Không có quyền truy cập!");
        } else {
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
