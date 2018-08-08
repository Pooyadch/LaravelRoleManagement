<?php

namespace Pooyadch\LaravelRoleManagement\Http\Middleware;

use Alive2212\LaravelMobilePassport\AliveMobilePassportRole;
use Alive2212\LaravelMobilePassport\LaravelMobilePassport;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
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
        LaravelMobilePassport::initAccessToken($request);
        $scopes = json_decode(((array)$request['access_token'])['scopes'], true);
        $requestMethodsName = Route::getCurrentRoute()->methods()[0];
        $requestControllerAddress = Route::getCurrentRoute()->getAction();
        $userRoles = UserRolePermission::where('role_name', '=', $scopes[0])
            ->where('method_name', '=', $requestMethodsName)
            ->orderBy('priority', 'ASC')
            ->get();
        if ($userRoles->isEmpty()) {
            $userRoles = UserRolePermission::where('role_name', '=', $scopes[0])
                ->where('method_name', '=', null)
                ->orderBy('priority', 'ASC')
                ->get();
        }
        foreach ($userRoles as $userRole) {
            $methodName = $userRole['method_name'];
            $controllerAddress = $userRole['controller_address'];
            $permissionType = $userRole['permission_type'];
            $access = $userRole['access'];
            $filter = $userRole['filter'];
            $filtertext = Input::post('filter');
            if ($controllerAddress === null and $methodName === null) {
                if ($access === 'Allow') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    return $next($request);
                } elseif (!is_null($request->file()) and $filter === '{' . $filtertext . '}') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    $request->files->remove('file');
                    return $next($request);

                }
            } elseif ($controllerAddress === null and $methodName === $requestMethodsName) {
                if ($access === 'Allow') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    return $next($request);
                } elseif (!is_null($request->file()) and $filter === '{' . $filtertext . '}') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    $request->files->remove('file');
                    return $next($request);
                }
            } elseif ($controllerAddress === $requestControllerAddress and $methodName === null) {
                if ($access === 'Allow') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    return $next($request);
                } elseif (is_null($request->file()) and $filter === '{' . $filtertext . '}') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    $request->files->remove('file');
                    return $next($request);
                }
            } elseif ($controllerAddress === $requestControllerAddress and $methodName === $requestMethodsName) {
                if ($access === 'Allow') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    return $next($request);
                } elseif (!is_null($request->file()) and $filter === '{' . $filtertext . '}') {
                    $request->attributes->add(["permission_type" => "$permissionType"]);
                    $request->files->remove('file');
                    return $next($request);
                }
            }else{
                return redirect(config('laravelrolemanagement.callbackUrlRoleManagement'));
            }
        }
        return redirect(config('laravelrolemanagement.callbackUrlRoleManagement'));

    }
}
