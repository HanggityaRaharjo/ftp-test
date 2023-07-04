<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class CommandController extends Controller
{
    public function make_controller(Request $request){
        $controllerName = 'MyController';
        Artisan::call('make:controller', [
        'name' => $controllerName,
        ]);
    }
}
