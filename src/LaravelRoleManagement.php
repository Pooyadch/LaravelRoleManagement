<?php

namespace Pooyadch\LaravelRoleManagement;

use Alive2212\LaravelMobilePassport\LaravelMobilePassport;
use Illuminate\Http\Request;

class LaravelRoleManagement
{
    public static function getAllRoute(Request $request)
    {
        LaravelMobilePassport::initAccessToken($request);
        $scopes = json_decode(((array)$request['access_token'])['scopes'],true);
        $userRole = UserRolePermission::where('role_name', '=', $scopes[0])->get();
        $userRoleMethods = $userRole[0]['method_name'];
        $userRoleRoute = $userRole[0]['route_name'];
        $allRoute = [
            'Route' =>$userRoleMethods,
            'Method'=>$userRoleRoute
        ];
        return $allRoute;

    }
}