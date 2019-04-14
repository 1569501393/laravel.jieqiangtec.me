<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Indexcontroller extends CommonController
{
    // 首页
    public function index()
    {
        // echo 111;
        return view('admin.index');
    }

    // 详情
    public function info()
    {
        // echo 111;
        return view('admin.info');
    }

    // 更改超级管理员密码
    public function pass()
    {
        $input = Input::all();
        // var_dump(isset($input['password']),$input);
        if (isset($input['password_o'])) {

            $rules = [
                'password' => 'required|between:6,20|confirmed',
            ];

            $messages = [
                'password.required' => '新密码不能为空',
                'password.between' => '新密码6-20位',
                'password.confirmed' => '新旧密码不一致',
            ];

            $validator = Validator::make($input, $rules, $messages);

            // dd($validator->passes());
            if ($validator->passes()) {
                $user = User::first();
                // echo 'yes'.$user->user_pass;exit;
                $_password = Crypt::decrypt($user->user_pass);
                // echo $_password.'yes'.$user->user_pass;exit;

                if ($input['password_o'] == $_password){
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();

                    // return redirect('admin/info');
                    // 不做跳转回详情页，本业提示
                    return back()->with('errors',['密码修改成功']);
                }else{
                    // return back()->with('errors','原密码错误');
                    return back()->with('errors',['原密码错误']);
                }
            }else {
                return back()->withErrors($validator);

                // dd($validator->errors()->all());
                // echo 'no';
            }
            // dd($input, $validator);
        }else {
            return view('admin.pass');
        }
    }
}
