<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 获取用户列表
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        1. 获取提交的请求参数
//        $input = $request->all();
//        dd($input);
        $user =  User::orderBy('user_id','asc')
            ->where(function($query) use($request){
                $username = $request->input('username');
                $email = $request->input('email');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }
                if(!empty($email)){
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):3);


//        $user = User::paginate(3);
        return view('admin.user.list',compact('user','request'));
    }

    /**
     * Show the form for creating a new resource.
     * 返回用户添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     * 显示一条用户记录
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接受前台提交的数据
        $input = $request->all();
        //进行表单验证

        //添加数据库
        $username = $input['email'];
        $pass = Crypt::encrypt('pass');
        $res = User::create(['user_name'=>$username,'user_pass'=>$pass,'email'=>$input['email']]);
        if($res){
            $data = [
                'status'=>0,
                'message'=>'添加成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'添加失败'
            ];

        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 返回一个修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * 执行修改操作
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        1. 根据id获取要修改的记录
        $user = User::find($id);
//        2. 获取要修改成的用户名
        $username = $request->input('user_name');

        $user->user_name = $username;

        $res = $user->save();

        if($res){
            $data = [
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     * 执行删除操作
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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

    //删除所有选中用户
    public function delAll(Request $request)
    {
        $input = $request->input('ids');
        dd($input);
//        $res = User::destroy($input);
//
//        if($res){
//            $data = [
//                'status'=>0,
//                'message'=>'删除成功'
//            ];
//        }else{
//            $data = [
//                'status'=>1,
//                'message'=>'删除失败'
//            ];
//        }
//        return $data;
    }

}
