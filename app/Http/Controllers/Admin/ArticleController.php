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
        // dd('文章列表');
        $data = Article::orderBy('art_id', 'DESC')->paginate(10);
        /*分页器实例方法*/
        /*dd($data->count(),
            $data->currentPage(),
            $data->firstItem(),
            $data->hasMorePages(),
            $data->lastItem(),
            $data->lastPage(),
            $data->nextPageUrl(),
            $data->perPage(),
            $data->previousPageUrl(),
            $data->total(),
            $data->url($data->lastPage()));*/
        // dd($data, $data->links());
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
        // 过滤_token字段 file_upload uploadify谷歌浏览器有兼容问题
        $input             = Input::except('_token', 'file_upload');
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


    /**
     * 编辑单个文章信息
     * GET|HEAD                               | admin/article/{article}/edit | article.edit
     */
    public function edit($art_id)
    {
        // $field = Category::where('cate_id', $cate_id)->get();
        $field = Article::find($art_id);
        $data  = (new Category)->tree();
        // dd($art_id, $field);
        // return view('admin.category.edit', compact('field'));
        return view('admin/article/add', compact('field', 'data'));

    }


    /**
     * 更新单个分文章信息
     * PUT|PATCH                              | admin/article/{article}      | category.update
     */
    public function update($art_id)
    {
        $input = Input::except('_token', '_method', 'file_upload');
        // dd($cate_id, $input);
        $res = Article::where('art_id', $art_id)->update($input);
        if ($res) {
            return redirect('admin/article');
        }else {
            return back()->withErrors(['文章信息更新失败，请稍后重试']);
        }
    }

    /**
     * 删除单个分类信息
     * DELETE                                 | admin/category/{category}      | category.destroy
     */
    public function destroy($art_id)
    {
        // dd($cate_id);
        $res = Article::where('art_id', $art_id)->delete();
        if ($res) {
            $data = [
                'status' => 0,
                'msg' => '文章删除成功',
            ];
        }else {
            $data = [
                'status' => 1,
                'msg' => '文章删除失败，请稍后重试',
            ];
        }
        return $data;
    }
}
