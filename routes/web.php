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

    Route::any('admin/login', 'Admin\LoginController@login');
    Route::get('admin/code', 'Admin\LoginController@code');
    Route::get('admin/getcode', 'Admin\LoginController@getcode');

    Route::any('admin/crypt', 'Admin\LoginController@crypt');
    Route::any('admin/test', 'Admin\LoginController@test');



});



