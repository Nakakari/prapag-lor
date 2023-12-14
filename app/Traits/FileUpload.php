<?php

namespace App\Traits;

trait FileUpload{

    public function file_upload($file , $path , $file_name, $extension = [])
    {

        $file->move(public_path($path),$file_name);

        $file_path = $path.'/'.$file_name;
        
        return $file_path;
    }


}