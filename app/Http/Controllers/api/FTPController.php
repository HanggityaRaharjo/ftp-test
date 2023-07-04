<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FTPConnect;

class FTPController extends Controller
{
    public function index(){
        $ftp = FTPConnect::all_contents();
        return response()->json($ftp);
    }

    public function store(Request $request){
        // $path = str_replace(",", "\\", $request->path);
        // $file = $request->file('file');
        // $file->move(base_path("\\".$path), $file->getClientOriginalName());

        // dd(FTPConnect::connect('asd','asd','asd','asd'));

        return back();
    }


    public function show(Request $request) {
        $path = '';
        for ($i=2; $i < count($request->current_path); $i++) { 
            $path = $path . '/' . $request->current_path[$i];
        }
        $ftp = FTPConnect::content($path);
        return response()->json($ftp);
    }
}
