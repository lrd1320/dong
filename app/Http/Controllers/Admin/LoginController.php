<?php

namespace App\Http\Controllers\Admin;

use App\Org\code\Code;
use Validator;
use Illuminate\Http\Request;
use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //后台登录页
    public function login(){
        return view('admin.login');
    }

    //验证码
    public function code(){
        $code = new Code();
        return $code->make();
    }

    //处理用户登录到方法 海风
    public function doLogin(Request $request){
        $input = $request->except('_token');

        //进行表单验证
//        $validator = $validator::make('需要验证的表单数据','验证规则','错误提示信息');
        //判断

        $rule = [
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18|alpha_dash',
        ];

        $msg = [
            'username.required' =>'用户名必须输入',
            'username.between' =>'用户名长度不够',
            'password.required' =>'密码必须输入',
            'password.between' =>'密码长度不够'
        ];

        $validator = Validator::make($input,$rule,$msg);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }

        if(strtolower($input['code']!=session()->get('code'))){
            return redirect('admin/login')->with('errors','验证码错误');
        }

        //验证是此用户

        $user =  User::where('user_name',$input['username'])->first();

        if(!$user){
            return redirect('admin/login')->with('errors','账号错误');
        }
        if($input['password']!=Crypt::decrypt($user->user_pass)){
            return redirect('admin/login')->with('errors','密码错误');
        }

        //保存用户信息session
        session()->put('user',$user);
        return redirect('admin/index');

    }

    //后台首页
    public function index(){
        return view('admin/index');
    }

    //后台欢迎页
    public function welcome(){
        return view('admin/welcome');
    }

    //退出登录
    public function logout(){
        //清空session信息
        session()->flush();
        return redirect('admin/index');
    }

    public function pwd(){
        $str = '123456';
        $crypt_str=Crypt::encrypt($str);
        return $crypt_str;
    }



}
