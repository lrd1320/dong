<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //获取授权页面
    public function auth($id){

        //获取当前角色
        $role = Role::find($id);
        //获取所有的权限列表
        $perms = Permission::get();

        //获取当前角色应有的权限
        $own_perms =  $role->permission;


        $own_pers = [];
        foreach ($own_perms as $v){
            $own_pers[] = $v->id;
        }

        return view('admin.role.auth',compact('role','perms','own_pers'));
    }

    //处理授权
    public function doAuth(Request $request){
        $input = $request->except('_token');
        //删除当前角色已有的权限
        Db::table('role_permission')->where('role_id',$input['role_id'])->delete();
        //添加新授权的权限
            foreach ($input['permission_id'] as $v){
               Db::table('role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$v]);
            }
        return redirect('admin/role');
    }

    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取所有的角色数据
        $role = Role::get();
        //返回视图
        return View('admin.role.list',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        获取表单数据
        $input = $request->except('_token');

//        将数据添加到Role表中
        $res = Role::create($input);
        if($res){
            return Redirect('admin/role');
        }else{
            return back()->with('msg','添加失败');
        }
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
