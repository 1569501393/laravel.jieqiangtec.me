<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $categorys = Category::all();
        return view('admin.category.index')->with('data', $categorys);
        dd($categorys);

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
