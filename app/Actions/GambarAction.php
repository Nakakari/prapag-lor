<?php

namespace App\Actions;

class GambarAction
{
    public function save($existFile, $image, $declarePath, $nameOfFile)
    {
        //code for remove old file
        \File::exists(public_path($existFile)) ?: (\File::delete(public_path($existFile)));

        //upload new file
        $file = $image;
        $filename = $declarePath . $nameOfFile . $file->getClientOriginalExtension();
        $file->move($declarePath, $filename);
        $column = $filename;
        return $column;
    }
}
