<?php

namespace App\Http\Controllers\Admin;

use App\http\model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    /**
     * 文章列表
     * @return $this
     *
     */
    public function index()
    {
        dd('文章列表');

        // 非静态方法
        $data = (new Category)->tree();
        return view('admin.article.index')->with('data', $data);
    }

    /**
     * 添加文章
     */
    public function create()
    {
        // dd('添加文章');
        // $data = Category::where('cate_pid', 0)->get();
        $data = (new Category)->tree();
        // return view('admin/category/add')->with('data',$data);
        return view('admin/article/add', compact('data'));
    }

    /**
     * 添加文章提交
     */
    public function store()
    {
        // $input = Input::all();
        // 过滤_token字段
        $input = Input::except('_token');
        $input['art_time'] = time();
        // dd($input);
        $rules = [
            'art_title' => 'required',
            'art_content' => 'required',
        ];

        $messages = [
            'art_title.required' => '文章标题不能为空',
            'art_content.required' => '文章内容不能为空',
        ];

        $validator = Validator::make($input, $rules, $messages);
        // dd($validator->passes());
        if ($validator->passes()) {
            $res = Article::create($input);
            // dd($res);
            if ($res) {
                return redirect('admin/article');
            }else {
                return back()->withErrors(['添加失败，请稍后重试']);
            }

        }else {
            return back()->withErrors($validator);
            // dd($validator->errors()->all());
            // echo 'no';
        }
    }
}
