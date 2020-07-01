<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Url;
use App\Cate;
use App\Admin;
use Validator;//第三种表单验证
use Illuminate\Validation\Rule;//第三种表单验证
class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url_name = request()->url_name;
        $where = [];
        if($url_name){
            $where[] = ["url_name","like","%$url_name%"];
        }
        $urlinate = config("app.pageSize");
        $url = Url::leftjoin("cate","url.cate_id","=","cate.cate_id")->where($where)->paginate($urlinate);
        return view("admins/index",["url"=>$url,"url_name"=>$url_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::all();
        return view("admins/create",["cate"=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //第三种表单验证  手册第330页-331页
        $validator = Validator::make($request->all(),
        [
            //'url_name' => 'required|unique:url', //名称不能为空 唯一性验证
            'url_name' => "regex:/^[\x{4e00}-\x{9fa5}\w-]{2,15}$/u|unique:url",
            'url_cate' => 'required',
            'url_new' => 'required',
            'url_hot' => 'required',
        ],[
            //转换为中文提示
            "url_name.regex"=>"文章标题格式不符合",
            "url_name.unique"=>"文章标题已存在",
            'url_cate.required' =>'文章分类不能为空',
            'url_new.required' =>'文章重要性不能为空',
            'url_hot.required' =>'是否显示不能为空', 
        ]);
        if ($validator->fails()) {//判断是否执行过验证 手册第330页-331页
            return redirect('url/create')//跳地址
            ->withErrors($validator)
            ->withInput();
            }
          //文件上传
        if($request->hasFile("url_img")){
           $url_img =upload("url_img");
        }
        // $url = $request->all();
        // $url = $request->except("_token");
        // $res = Url::insert($url);
        // if($res){
        //     return redirect("url/index");
        // }
        $url = new Url;
        $url->url_name = $request->url_name;
        $url->cate_id = $request->cate_id;
        $url->url_new = $request->url_new;
        $url->url_img = $url_img;
        $url->url_mans = $request->url_mans;
        $url->url_desc = $request->url_desc;
        $url->url_hot = $request->url_hot;
        $url->url_email = $request->url_email;
        $url->url_nas = $request->url_nas;
        $url->url_time = time();
        $res = $url->save();
        if($res){
            return redirect("url/index");
        }
    }
    //  //文件上传
    public function upload($fileimg){
        $file = request()->file($fileimg);
        if($file->isValid()){
            $path = $file->store("uploads");
            return $path;
        }
        exit("文件上传错误");
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
    public function edit(Request $request)
    {
        return view("admins/user");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = $request->all();
        //dd($post);
        $admin = Admin::where("admin_name",$post["admin_name"])->first();
        //判断账号是否存在
        if(!$admin){
            return redirect("url/user")->with("msg","用户名或密码错误");
        }
        //如果存在解密密码 如果密码错误 给出提示
        if(decrypt($admin->admin_pwd)!=$post["admin_pwd"]){
            return redirect("url/user")->with("msg","用户名或密码错误");
        }
        //存session
        request()->session()->put("admin",$admin);
        //七天免登录
        if(isset($post["rember"])){
            Cookie::queue("admin",serialize($admin),60*24*7);
        }
        return redirect("url/index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Url::destroy($id);
        if(request()->ajax()){
            return json_encode(['code'=>'1','msg'=>"删除成功"]);
        }
        return redirect("index");
    }
    public function checkend(){
        $url_name = request()->url_name;
        $count = Url::where("url_name",$url_name)->count();
        return json_encode(["code"=>"0","count"=>$count]);
    }
}
