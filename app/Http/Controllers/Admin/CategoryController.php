<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreBlogPost;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        //无限极分类
        $category = CateTrue($category);
        return view("admin/category/index",["category"=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *添加展示
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all(); 
        //无限极分类
        $category = CateTrue($category);
        return view("admin/category/category",['category'=>$category]);
    } 


    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        //第二种表单验证
        $category = new Category;
        $category->cate_name = $request->cate_name;
        $category->pid = $request->pid;
        $category->cate_show = $request->cate_show;
        $category->cate_nav_show = $request->cate_nav_show;
        $res = $category->save();
        if($res){
            return redirect("category/index");
        }
    }

    /**
     * Display the specified resource.
     *预览详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *展示修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $categorys = Category::find($id);
        $category =CateTrue($category);
        return view("admin/category/edit",['category'=>$category,'categorys'=>$categorys]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, $id)
    {
        $category =  Category::find($id);
        $category->cate_name = $request->cate_name;
        $category->pid = $request->pid;
        $category->cate_show = $request->cate_show;
        $category->cate_nav_show = $request->cate_nav_show;
        $res = $category->save();
        if($res){
            return redirect("category/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $count = Category::where("pid",$id)->count();
        if($count>0){
            echo "<script>alert('此分类下有子分类,禁止删除');history.go(-1)</script>";
        }else{
           $category = Category::destroy($id);
        return redirect('category/index');  
        }
    }
    public function checkname(){
        $cate_name = request()->cate_name;
        $count = Category::where("cate_name",$cate_name)->count();
        //echo $count;
        return json_encode(["code"=>"1","count"=>$count]);
    }
    //批量删除
    public function checkdel(){
        $cate_id = request()->cate_id;
        $str = explode(",",$cate_id);
        //利用循环将需要删除的id 一个一个进行执行sql；
        foreach($str as $v){
        $deletes = Category::where('cate_id',"=","$v")->delete();
        //return json_encode(["code"=>"1","deletes"=>$deletes]);
        }
    }
}
