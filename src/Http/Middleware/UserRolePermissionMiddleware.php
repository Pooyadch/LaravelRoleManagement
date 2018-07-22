<?php

namespace Pooyadch\LaravelRoleManagement\Http\Middleware;

use Alive2212\LaravelMobilePassport\AliveMobilePassportRole;
use Alive2212\LaravelMobilePassport\LaravelMobilePassport;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
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
//        LaravelMobilePassport::initAccessToken($request);
//        $scopes = json_decode(((array)$request['access_token'])['scopes'],true);
        $scopes = 'staff';
        $routeMethods = Route::getCurrentRoute()->methods()[0];
        $routeAddress = Route::getCurrentRoute()->uri();
        $userRole = UserRolePermission::where('role_name', '=', $scopes)->get();
        $userRoleMethods = $userRole[0]['method_name'];
        $userRoleRoute = $userRole[0]['route_name'];
        $permissionType = $userRole[0]['permission_type'];
        if ($userRoleMethods === null and $userRoleRoute = null){
            return $next($request);
        }else {
            if ($routeMethods === $userRoleMethods and $routeAddress === $userRoleRoute) {
                $request->attributes->add(["permission_type" => "$permissionType"]);
                return $next($request);
            } else {
                return redirect(config('laravelrolemanagement.callbackUrlRoleManagement'));
            }
        }
    }
}
