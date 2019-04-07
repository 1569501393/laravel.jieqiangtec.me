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
        if ($_POST) {
            // dd($_POST);
            $code  = new \Code();
            $_code = $code->get();
            if (strtoupper($_POST['code']) != $_code) {
                return back()->with('msg', '验证码错误');
            }

            $user = User::first();
            if (($user->user_name != $_POST['user_name']) || (Crypt::decrypt($user->user_pass) != $_POST['user_pass'])) {
                return back()->with('msg', '用户名或者密码错误');
            }

            session(['user' => $user]);
            dd(session('user'), $user);

        }else {
            // dd($user = User::first());
            return view('admin.login');
        }
    }

    /**
     *
     */
    public function code()
    {
        $code = new \Code();
        $code->make();
    }

    /**
     *
     */
    public function getCode()
    {
        $code = new \Code();
        echo $code->get();
    }


    public function crypt()
    {
        $str = '123456';
        // eyJpdiI6IkYxZkNDZlgwVEhuRU9VZ08xamkwcGc9PSIsInZhbHVlIjoibFNZOG9PRzR1T3c0K3lpN1ZFOW1PZz09IiwibWFjIjoiMmExMDQzODJjM2M4MWVmNDZkMWJhZjM2ZmQ4YmUxNjE3ZDNmZmYwNWI3NmM4N2Y0NmNkY2EzNzZjYjBhYWIwNiJ9
        $strPass    = 'eyJpdiI6IkYxZkNDZlgwVEhuRU9VZ08xamkwcGc9PSIsInZhbHVlIjoibFNZOG9PRzR1T3c0K3lpN1ZFOW1PZz09IiwibWFjIjoiMmExMDQzODJjM2M4MWVmNDZkMWJhZjM2ZmQ4YmUxNjE3ZDNmZmYwNWI3NmM4N2Y0NmNkY2EzNzZjYjBhYWIwNiJ9';
        $strEncrypt = Crypt::encrypt($str);
        $strDecrypt = Crypt::decrypt($strPass);

        dd($strEncrypt, $strDecrypt);
    }

    public function test()
    {
        $test    = DB::table('test')->first();
        $testAll = Test::all();
        dd($test, $testAll);
    }
}
