<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FTPConnect
{
    
    public static  function all_contents()
    {
        $files = Storage::disk('sftp')->files();
        $folder = Storage::disk('sftp')->directories();
        return [ 
            "files" => $files,
            "folder" => $folder,
        ];
    }

    public static  function content($path)
    {
        
        $files = Storage::disk('sftp')->files($path);
        $result_file = [];
        foreach ($files as $item_file) {
            $parts_file = explode('/', $item_file);
            $lastPart_file = end($parts_file);
            $result_file[] = basename($lastPart_file);   
        }
        $files = $result_file;
        
        

        $folder = Storage::disk('sftp')->directories($path);
        $result_folder = [];
        foreach ($folder as $item_folder) {
            $parts_folder = explode('/', $item_folder);
            $lastPart_folder = end($parts_folder);
            $result_folder[] = basename($lastPart_folder);   
        }
        $folder = $result_folder;
     
        return [ 
            "files" => $files,
            "folder" => $folder,
        ];
    }

}
