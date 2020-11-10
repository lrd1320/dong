<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //添加方法
    /*
     * 获取一个添加页面
     * */
    public function add(){
        return view('user.add');
    }

    public function store(Request $request){
//       获取客户端提交的表单数据
        $input = $request->except('_token');
        $input['password'] = md5($input['password']);
//        $res = User::created(['username'=>$input['username'],'password'=>$input['password']]);
        //添加
        $res = User::create($input);
        if($res){
            return redirect('user/index');
        }
    }

    //用户列表页
    public function index(){
        //获取用户数据
        $user=User::get();
        //返回用户列表
//        return view('user.list',['user'=>$user]);
//        return view('user.list')->with('user',$user);
        return view('user.list',compact('user'));
    }

    //修改页面
    public function edit ($id){
        //根据要修改的记录的id，找到修改用户
        $user = User::find($id);
        //返回修改界面
        return view('user.edit',compact('user'));
    }

    //修改确认
    public function update(Request $request){
        //接受用户名跟id
        $input = $request->all();
        $user = User::find($input['id']);
        $res = $user->update(['username'=>$input['username']]);
        if($res){
            return redirect('user/index');
        }else{
            return back();
        }
    }

    public function destroy($id){
        $user = User::find($id);

        $res = $user->delete();

        if($res){
            $data = [
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        return $data;
    }

}
