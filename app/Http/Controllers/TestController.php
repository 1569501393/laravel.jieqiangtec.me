<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // 测试数据库连接
        // $user            = DB::table('user')->get();

        // 获取user_id=1的用户，返回二维数组
        $user1 = User::where('user_id', 1)->get();
        $user1 = User::where('user_id', 1)->first();

        // 获取user_id=1的用户，返回一维数组
        $user = User::find(1);
        dd($user1, $user);

        $user->user_name = 'wangwu';
        $res             = $user->update();
        dd($user, $res);

        // 测试数据库连接
        // $user = User::query()->where('user_id',1)->get();
        /*$user = User::where('user_id', 1)->get();
        dd($user);*/

        // 测试数据库连接
        // $user = DB::table('user')->where('user_id', 1)->get();

        // 获取第一行数据
        // $user = DB::table('user')->find(1);

        // 获取第一行数据
        // $user = DB::table('user')->first();
        // dd($user,$res);


        dd(111);
    }
}
