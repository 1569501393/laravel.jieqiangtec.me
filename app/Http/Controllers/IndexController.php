<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        // 测试数据库连接
        $user = DB::table('user')->where('user_id',1)->get();
        dd($user);

        // 测试数据库连接
        $user = DB::table('user')->get();
        dd($user);

        dd(111);
    }
}
