<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FTPConnect;


class CobaController extends Controller
{
    public function index(){
        dd(FTPConnect::connect('asd','asd','asd','asd'));
    }
}
