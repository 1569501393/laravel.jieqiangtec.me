<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Route::get('/', function () {
    return view('welcome');
});*/

// 后面的路由覆盖前面的
//Route::get('/test', 'IndexController@index');
// Route::get('/', 'IndexController@index');

Route::get('/', function (){
    return view('welcome');
});

Route::group(['middleware' => ['web']], function (){

    Route::get('/', function (){
        return view('welcome');
    });

    Route::get('/test', 'IndexController@index');

    // 后台登录
    Route::any('admin/login', 'Admin\LoginController@login');
    // 后台验证码
    Route::get('admin/code', 'Admin\LoginController@code');
    // 后台获取验证码session
    Route::get('admin/getcode', 'Admin\LoginController@getcode');
    // 后台加密
    Route::any('admin/crypt', 'Admin\LoginController@crypt');

    // 后台测试路由
    Route::any('admin/test', 'Admin\LoginController@test');

    // 后台首页
    /*Route::any('admin/index', 'Admin\IndexController@index');
    Route::any('admin/info', 'Admin\IndexController@info');*/

});


/*Route::group(['middleware' => ['web', 'admin.login']], function (){
    // 后台首页
    Route::any('admin/index', 'Admin\IndexController@index');
    Route::any('admin/info', 'Admin\IndexController@info');
    Route::any('admin/quit', 'Admin\LoginController@quit');
});*/

/**
 * 路由前缀和命名空间
 */
Route::group(['middleware' => ['web', 'admin.login'], 'prefix'=>'admin', 'namespace'=>'Admin'], function (){
    // 后台首页
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');

    // 修改密码
    Route::any('pass', 'IndexController@pass');

    // 修改分类排序
    Route::post('cate/changeorder', 'CategoryController@changeOrder');

    // 文章分类 资源路由
    Route::resource('category', 'CategoryController');

    // 文章 资源路由
    Route::resource('article', 'ArticleController');

    // 文件上传
    Route::any('upload', 'CommonController@upload');

    Route::post('links/changeorder', 'LinksController@changeOrder');
    Route::resource('links', 'LinksController');

    Route::post('navs/changeorder', 'NavsController@changeOrder');
    Route::resource('navs', 'NavsController');

    Route::get('config/putfile', 'ConfigController@putFile');
    Route::post('config/changecontent', 'ConfigController@changeContent');
    Route::post('config/changeorder', 'ConfigController@changeOrder');
    Route::resource('config', 'ConfigController');

});




