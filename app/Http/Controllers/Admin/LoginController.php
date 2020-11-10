<?php

namespace App\Http\Controllers\Admin;

use App\Org\code\Code;
use Validator;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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

        $rule = [
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18|alpha_dash',
        ];
        $validator = Validator::make($input,$rule);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }

    }

}
