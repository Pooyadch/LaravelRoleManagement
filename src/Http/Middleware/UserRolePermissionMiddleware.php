<?php

namespace Pooyadch\LaravelRoleManagement\Http\Middleware;

use Alive2212\LaravelMobilePassport\AliveMobilePassportRole;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Pooyadch\LaravelRoleManagement\UserRolePermission;


class UserRolePermissionMiddleware
{
    /**
     * LaravelRoleManagement
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = "staff";
        $routeMethods = Route::getCurrentRoute()->methods()[0];
        $routeAddress = Route::getCurrentRoute()->uri();
        $userRole = UserRolePermission::where('role_name', '=', $user)->get();
        $userRoleMethods = $userRole[0]['method_name'];
        $userRoleRoute = $userRole[0]['controller_name'];
        if ($userRoleMethods === null and $userRoleRoute = null){
            return $next($request);
        }else {
            if ($routeMethods === $userRoleMethods and $routeAddress === $userRoleRoute) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
    }
}
