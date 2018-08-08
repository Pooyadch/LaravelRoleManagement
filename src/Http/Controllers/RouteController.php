<?php

namespace Pooyadch\LaravelRoleManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class RouteController extends Controller
{
    public static function allRoute()
    {
        $routeCollection = Route::getRoutes();
        $routeurl = [];
//        dd( $routeCollection);
        foreach ($routeCollection as $value) {
            array_push($routeurl, $value->uri());
//            return $value->uri();
        }

        return $routeurl;
    }
    public function allController()
    {
        $searchValue = null;
        $routeCollection = Route::getRoutes();
        $routeurls = [];
        foreach ($routeCollection as $value) {
            array_push($routeurls, $value->getAction('controller'));
        }

        $collection = collect($routeurls);
        $keyword = Input::post('keyword');
        if (!is_null($keyword)) {
            $filtered = $collection->filter(function ($value, $key) {
                if (strpos($value, Input::post('keyword')) !== false) {
                    $responce = false;
                    return $value !== $responce;
                }
            });

            $resault = $filtered->all();
            return $resault;
        }else{
            return $routeurls;
        }
//        dd($routeurls1);


    }

    public static function allMethods()
    {
        $controller = Input::post('keyword');
        $path = Input::post('Path');
        $path = str_replace("\\\\","\\",$path);
        $actions = get_class_methods("".$path."\\".$controller);
        return $actions;

    }





}
