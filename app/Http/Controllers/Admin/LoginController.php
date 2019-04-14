<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Test;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

// 引入验证码
require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        // $input = Input::all();
        //  dd($input); // "s" => "/admin/login"
        // dd(Input::post());
        if ($input = Input::all()) {
            // dd($input);
            $code  = new \Code();
            $_code = $code->get();
            if (strtoupper($input['code']) != $_code) {
                return back()->with('msg', '验证码错误');
            }

            $user = User::first();
            if (($user->user_name != $input['user_name']) || (Crypt::decrypt($user->user_pass) != $input['user_pass'])) {
                return back()->with('msg', '用户名或者密码错误');
            }

            session(['user' => $user]);

            // dd(session('user'), $user);
            return redirect('admin/index');

        }else {
            // dd($user = User::first());
            // 清空session
            session(['user'=>null]);
            return view('admin.login');
        }
    }

    /**
     * 创建验证码
     */
    public function code()
    {
        $code = new \Code();
        $code->make();
    }

    /**
     * 获取验证码
     */
    public function getCode()
    {
        $code = new \Code();
        echo $code->get();
    }


    /**
     * 密码加密
     */
    public function crypt()
    {
        $str = '123456';
        // eyJpdiI6IkYxZkNDZlgwVEhuRU9VZ08xamkwcGc9PSIsInZhbHVlIjoibFNZOG9PRzR1T3c0K3lpN1ZFOW1PZz09IiwibWFjIjoiMmExMDQzODJjM2M4MWVmNDZkMWJhZjM2ZmQ4YmUxNjE3ZDNmZmYwNWI3NmM4N2Y0NmNkY2EzNzZjYjBhYWIwNiJ9
        // eyJpdiI6ImE2WW5vOWJyRnBGSWI2SXBIZHZ1SUE9PSIsInZhbHVlIjoibnlFRlVoSm5TSUgzbkxHR1NidVIwQT09IiwibWFjIjoiOWM3NjU2MDZjNWJlOWY5OGU1ODAwZmIxMjAzNzdmZTE3YjYyYzkzMDI0NmU0YjVlMzljNzQwM2FiMDcxZGZjYyJ9

        $strPass    = 'eyJpdiI6IkYxZkNDZlgwVEhuRU9VZ08xamkwcGc9PSIsInZhbHVlIjoibFNZOG9PRzR1T3c0K3lpN1ZFOW1PZz09IiwibWFjIjoiMmExMDQzODJjM2M4MWVmNDZkMWJhZjM2ZmQ4YmUxNjE3ZDNmZmYwNWI3NmM4N2Y0NmNkY2EzNzZjYjBhYWIwNiJ9';
        $strEncrypt = Crypt::encrypt($str);
        $strDecrypt = Crypt::decrypt($strPass);

        dd($strEncrypt, $strDecrypt);
    }


    /**
     * 退出登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    /**
     * 测试代码
     */
    public function test()
    {
        $test    = DB::table('test')->first();
        $testAll = Test::all();
        dd($test, $testAll);
    }
}
