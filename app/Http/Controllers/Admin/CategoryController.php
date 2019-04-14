<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 *
 * $ php artisan route:list
 * +--------+----------------------------------------+--------------------------------+------------------+-------------------------------------------------------+-----------------+
 * | Domain | Method                                 | URI                            | Name             | Action                                                | Middleware      |
 * +--------+----------------------------------------+--------------------------------+------------------+-------------------------------------------------------+-----------------+
 * |        | GET|HEAD                               | /                              |                  | Closure                                               | web             |
 * |        | GET|HEAD                               | admin/category                 | category.index   | App\Http\Controllers\Admin\CategoryController@index   | web,admin.login |
 * |        | POST                                   | admin/category                 | category.store   | App\Http\Controllers\Admin\CategoryController@store   | web,admin.login |
 * |        | GET|HEAD                               | admin/category/create          | category.create  | App\Http\Controllers\Admin\CategoryController@create  | web,admin.login |
 * |        | DELETE                                 | admin/category/{category}      | category.destroy | App\Http\Controllers\Admin\CategoryController@destroy | web,admin.login |
 * |        | PUT|PATCH                              | admin/category/{category}      | category.update  | App\Http\Controllers\Admin\CategoryController@update  | web,admin.login |
 * |        | GET|HEAD                               | admin/category/{category}      | category.show    | App\Http\Controllers\Admin\CategoryController@show    | web,admin.login |
 * |        | GET|HEAD                               | admin/category/{category}/edit | category.edit    | App\Http\Controllers\Admin\CategoryController@edit    | web,admin.login |
 */
class CategoryController extends CommonController
{
    /**
     * 分类列表
     * get GET|HEAD                               | admin/category                 | category.index   | App\Http\Controllers\Admin\CategoryController@index
     */
    public function index()
    {
        /*$categorys = Category::all();
        $data      = $this->getTree($categorys, 'cate_name', 'cate_id', 'cate_pid', 0);*/
        // 静态方法
        // $data = Category::tree();

        // 非静态方法
        $data = (new Category)->tree();
        return view('admin.category.index')->with('data', $data);
        dd($categorys);

    }


    /**
     * @param $data
     * @param string $field_name
     * @param string $field_id
     * @param string $field_pid
     * @param int $pid_value
     * @return array
     */
    /*public function getTree($data, $field_name = 'cate_name', $field_id = 'id', $field_pid = 'pid', $pid_value = 0)
    {
        $arr = [];
        foreach ($data as $k => $v) {
            if ($v->$field_pid == $pid_value) {
                // var_dump($v->cate_name);
                $data[$k]['_' . $field_name] = $data[$k][$field_name];
                $arr[]                       = $data[$k];
                foreach ($data as $m => $n) {
                    if ($n->$field_pid == $v->$field_id) {
                        $data[$m]['_' . $field_name] = '├─' . $data[$m][$field_name];
                        $arr[]                       = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }*/


    /**
     * 修改排序
     */
    public function changeOrder()
    {
        $input            = Input::all();
        $cate             = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $res              = $cate->update();
        // dd($input, $res);

        if ($res) {
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功',
            ];
        }else {
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败,请稍后重试',
            ];
        }
        return $data;
    }

    /**
     * POST                                   | admin/category                 | category.store   | App\Http\Controllers\Admin\CategoryController@store
     */
    public function store()
    {

    }

    /**
     * 添加分类
     *  GET|HEAD                               | admin/category/create          | category.create  | App\Http\Controllers\Admin\CategoryController@create
     */
    public function create()
    {

    }

    /**
     * 删除单个分类信息
     * DELETE                                 | admin/category/{category}      | category.destroy | App\Http\Controllers\Admin\CategoryController@destroy
     */
    public function destroy()
    {

    }


    /**
     * 更新单个分类信息
     * PUT|PATCH                              | admin/category/{category}      | category.update  | App\Http\Controllers\Admin\CategoryController@update
     */
    public function update()
    {

    }

    /**
     * 显示单个分类信息
     * GET|HEAD                               | admin/category/{category}      | category.show    | App\Http\Controllers\Admin\CategoryController@show    | web,admin.login
     */
    public function show()
    {

    }

    /**
     * 编辑单个分类信息
     * GET|HEAD                               | admin/category/{category}/edit | category.edit    | App\Http\Controllers\Admin\CategoryController@edit
     */
    public function edit()
    {

    }
}
