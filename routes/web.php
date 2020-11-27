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





Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    //后台登录路由
    Route::get('login','LoginController@login');
    //后台登录路由
    Route::post('doLogin','LoginController@doLogin');
    //验证码路由
    Route::get('code','LoginController@code');
    //密码加密路由
    Route::get('pwd','LoginController@pwd');

});



Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['isLogin']],function(){
//后台首页路由
    Route::get('index','LoginController@index');
//后台欢迎页
    Route::get('welcome','LoginController@welcome');
//后台退出登录路由
    Route::get('logout','LoginController@logout');
    //用户后台模块
    Route::get('user/del','UserController@delAll');
    Route::resource('user','UserController');

    //角色模块
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    Route::resource('role','RoleController');
});























//用户添加路由
Route::get('user/add','Usercontroller@add');

//用户执行添加路由
Route::post('user/store','Usercontroller@store');

//用户列表类路由
Route::get('user/index','Usercontroller@index');

//用户修改路由
Route::get('user/edit/{id}','Usercontroller@edit');

//用户执行添加路由
Route::post('user/update','Usercontroller@update');

//用户删除路由
Route::get('user/del/{id}','Usercontroller@destroy');