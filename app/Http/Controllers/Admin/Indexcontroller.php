<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Indexcontroller extends CommonController
{
    //
    public function index()
    {
        // echo 111;
        return view('admin.index');
    }

    public function info()
    {
        // echo 111;
        return view('admin.info');
    }
}
