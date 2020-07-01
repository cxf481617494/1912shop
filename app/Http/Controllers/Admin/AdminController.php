<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Validator;//第三种表单验证
use Illuminate\Validation\Rule;//第一二种表单验证
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索接值
        $admin_name = request()->admin_name;
        $where = [];
        if($admin_name){
            $where[] = ["admin_name","like","%$admin_name%"];
        }
        $admininate = config("app.pageSize");
        $admin = Admin::where($where)->orderBy("admin_id",'desc')->paginate($admininate);
        return view("admin/admin/index",['admin'=>$admin,"admin_name"=>$admin_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/admin/admin");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          // //第一种表单验证   手册第317页
        $validatedData = $request->validate([
                'admin_name' => 'regex:/^[\u4e00-\u9fa5\w]{2,4}$/u|unique:admin',//名称不能为空 唯一性验证
                'admin_pwd' => 'regex:/^\w{5,12}$/',//密码不能为空
            ],[
            //转换为中文提示
                "admin_name.regex"=>"管理员名称需由，2-4位汉字组成",
                "admin_name.unique"=>"管理员姓名已存在",
                "admin_pwd.regex"=>"密码需由数字字母下划线组成，长度6-12位",
               ]);
        //文件上传
        if($request->hasFile("admin_img")){
            $admin_img = $this->upload("admin_img");
        }
        $admin = new Admin;
        $admin->admin_name = $request->admin_name;
        $admin->admin_pwd = encrypt($request->admin_pwd);
        $admin->admin_img= $admin_img;

        $res = $admin->save();
        if($res){
            return redirect("admin/index");
        }

    }
    //封装一个文件上传
    public function upload($fileimg)
    {
        $file = request()->file($fileimg);
        if($file->isValid()){
            $path = $file->store("uploads");
            return $path;
        }
        exit("文件上传失败");
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
        $admin = Admin::find($id);
        return view("admin/admin/edit",["admin"=>$admin]);
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

          // //第一种表单验证   手册第317页
        $validatedData = $request->validate([
                'admin_name' => [
                'required',
                Rule::unique('admin')->ignore($id,"admin_id")//强制一个忽略给定 ID  手册第356页
                ],//名称不能为空 唯一性验证
                'admin_pwd' => 'required',//密码不能为空
            ],[
            //转换为中文提示
                "admin_name.required"=>"管理员姓名必填",
                "admin_name.unique"=>"管理员姓名已存在",
                "admin_pwd.required"=>"管理员密码必填",
               ]);
        //文件上传
        if($request->hasFile("admin_img")){
            $admin_img = $this->upload("admin_img");
        }
        $admin = Admin::find($id);
        $admin->admin_name = $request->admin_name;
        $admin->admin_pwd = decrypt($request->admin_pwd);
        if(isset($admin_img)){
            $admin->admin_img= $admin_img;
        }

        $res = $admin->save();
        if($res){
            return redirect("admin/index");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::destroy($id);
        return redirect("admin/index");
    }
    //js验证
    public function checkname(){
        $admin_name = request()->admin_name;
        //echo($admin_name);
        $count  = Admin::where("admin_name",$admin_name)->count();
        return json_encode(["code"=>"1","count"=>$count]);
    }
     //批量删除
    public function checkdel(){
        $admin_id = request()->admin_id;
        $str = explode(",",$admin_id);
        //利用循环将需要删除的id 一个一个进行执行sql；
        foreach($str as $v){
        $deletes = Admin::where('admin_id',"=","$v")->delete();
        //return json_encode(["code"=>"1","deletes"=>$deletes]);
        }
    }
}
