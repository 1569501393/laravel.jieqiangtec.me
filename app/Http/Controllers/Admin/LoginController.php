<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

// 引入验证码
require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
//        echo 111;
        return view('admin.login');
    }

    /**
     *
     */
    public function code()
    {
        $code = new \Code();
        $code->make();
    }

    public function getCode()
    {
        $code = new \Code();
        echo $code->get();
    }

}
