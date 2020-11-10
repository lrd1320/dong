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

Route::get('/', function () {
    return view('welcome');
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

//后台登录路由
Route::get('admin/login','Admin\LoginController@login');

//验证码路由
Route::get('admin/code','Admin\LoginController@code');

//后台登录路由
Route::post('admin/doLogin','Admin\LoginController@doLogin');
