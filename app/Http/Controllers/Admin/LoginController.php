<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate \Support\Facades\Cookie;
use App\Admin;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = request()->session()->get("admin");
        //dd($res);
        return view("admin/login/home",["res"=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/login/login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();
        //dd($post);
        $admin = Admin::where("admin_name",$post["admin_name"])->first();
        //判断账号是否存在
        if(!$admin){
            return redirect("/")->with("msg","用户名或密码错误");
        }
        //如果存在解密密码 如果密码错误 给出提示
        if(decrypt($admin->admin_pwd)!=$post["admin_pwd"]){
            return redirect("/")->with("msg","用户名或密码错误");
        }
        //存session
        request()->session()->put("admin",$admin);
        //七天免登录
        if(isset($post["rember"])){
            Cookie::queue("admin",serialize($admin),60*24*7);
        }
        return redirect("login/index");
   
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
