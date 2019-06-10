<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    /**
     * 图片上传
     * @return string
     */
    public function upload()
    {
        // dd('图片上传');
        // $input = Input::all();
        $file = Input::file('Filedata');
        if ($file->isValid()) {
            // $realPath  = $file->getRealPath(); // 临时文件绝对路径
            $extension = $file->getClientOriginalExtension(); // 上传文件后缀
            $newName   = date('YmdHis') . mt_rand(100, 999) . '.' . $extension; //重命名
            // $path = $file->move(app_path().'/storage/uploads/', $newName); // 文件移动
            $path = $file->move(base_path() . '/uploads/', $newName); // 文件移动
        }

        $filepath = 'uploads/'.$newName;
        return $filepath;
        // dd($path, $extension, $file->isValid(), $file);
    }
}
