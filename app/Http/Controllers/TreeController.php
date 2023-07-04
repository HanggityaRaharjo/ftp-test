<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TreeController extends Controller
{
    
    public function index(){
// dd('sampe sini');
    function generateTree($directory)
    {
        $tree = [];
        $files = File::files($directory);
        $directories = File::directories($directory);

        foreach ($directories as $dir) {
            $tree[] = [
                'name' => basename($dir),
                'type' => 'folder',
                'children' => generateTree($dir)
            ];
        }

        foreach ($files as $file) {
            $tree[] = [
                'name' => basename($file),
                'type' => 'file'
            ];
        }

        return $tree;
    }
    $rootPath = public_path(); // Path awal (root) dari struktur tree, sesuaikan dengan kebutuhan Anda
    $tree = generateTree($rootPath);

   
    
    return view('tree', compact('tree'));
    }
}
