<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use function PHPUnit\Framework\fileExists;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function file_upload($file, $folder){
        $pro_file = $file;
        $file_extension = $pro_file->getClientOriginalExtension();
        $pro_img_name = time().rand().'.'.$file_extension;
        $pro_file->move($folder,$pro_img_name);
        return $pro_img_name;
    }
    protected function file_updated($file, $folder, $old_file){
        if($old_file != null){
            fileExists($folder.$old_file) ? unlink($folder.$old_file) : false;
        }
        $pro_file = $file;
        $file_extension = $pro_file->getClientOriginalExtension();
        $pro_img_name = time().rand().'.'.$file_extension;
        $pro_file->move($folder,$pro_img_name);
        return $pro_img_name;
    }
    protected function file_remove($folder, $old_file){
        return fileExists($folder.$old_file) ? unlink($folder.$old_file) : false;
    }
}
