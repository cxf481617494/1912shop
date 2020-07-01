<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBlogPost;//第二种表单验证
use Validator;//第三种表单验证
use Illuminate\Validation\Rule;//第一二种表单验证
//引入缓存
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminaste\Http\Response
     */
    public function index()
    {
        //缓存
        $page = request()->page??1; //每页

        //接搜索值
        $brand_name = request()->brand_name;
        $where = [];
        if($brand_name){
            $where[] = ["brand_name","like","%$brand_name%"];
        }

            //缓存
           $brand = Cache::get("brand_".$page);//取缓存 拼接上每页
           if(!$brand){//如果没有从数据库取 在保存到memcareac
            echo "DB==";

        //$brand = Db::table("brand")->get();
       //$brand = Brand::orderBy("brand_id",'desc')->get();
       $brandinate = config("app.pageSize");
       $brand = Brand::where($where)->orderBy("brand_id",'desc')->paginate($brandinate);


        //缓存
        Cache::put("brand_".$page,$brand,60);//60秒后过期
       }
       return view("admin/brand/index",["brand"=>$brand,"brand_name"=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *展示添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/brand/brand");
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种表单验证
    //public function store(StoreBlogPost $request)
    public function store(Request $request)
    {
        // //第一种表单验证   手册第317页
        $validatedData = $request->validate([
                'brand_name' => 'regex:/^[\u4e00-\u9fa5\w]{2,15}$/u|unique:brand',//名称不能为空 唯一性验证
                'brand_url' => 'required',//网址不能为空
            ],[
            //转换为中文提示
                "brand_name.regex"=>"品牌名称需由中文、字母、数字、下划线长度2-15位组成",
                "brand_name.unique"=>"品牌名称已存在",
                "brand_url.required"=>"品牌网址必填",
               ]);
        //第三种表单验证  手册第330页-331页
        // $validator = Validator::make($request->all(),
        // [
        //     'brand_name' => 'required|unique:brand',//名称不能为空 唯一性验证
        //     'brand_url' => 'required',//网址不能为空
        // ],[
        //            //转换为中文提示
        //     "brand_name.required"=>"品牌名称必填",
        //     "brand_name.unique"=>"品牌名称已存在",
        //     "brand_url.required"=>"品牌网址必填",
        // ]);
        // if ($validator->fails()) {//判断是否执行过验证 手册第330页-331页
        //     return redirect('brand/brand')//跳地址
        //     ->withErrors($validator)
        //     ->withInput();
        //     }

            
        //$brand = $request->except("_token");
        //文件上传
        if($request->hasFile('brand_logo')) {
            $brand_logo = upload("brand_logo");
        }
        
        //$res = DB::table("brand")->insert($brand);
        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_url = $request->brand_url;
        $brand->brand_logo = $brand_logo;
        $brand->brand_desc = $request->brand_desc;
        $res = $brand->save();
        if($res){
          return redirect("brand/index");
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
     *展示修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$brand = DB::table("brand")->where("brand_id",$id)->first();
        $brand = Brand::find($id);
        //$brand = Brand::where("brand_id",$id)->first();
        //dd($brand);
        return view("admin/brand/edit",["brand"=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //dd($id);
       //$brand = $request->except("_token");
       //$res = DB::table("brand")->where("brand_id",$id)->update($brand);
   

        // //第一种表单验证   手册第317页
        $validatedData = $request->validate([
            'brand_name' =>[
                 'required',//名称不能为空 唯一性验证
                  Rule::unique('brand')->ignore($id,"brand_id")//强制一个忽略给定 ID  手册第356页
                ],
            'brand_url' => 'required',//网址不能为空
            ],[
            //转换为中文提示
                "brand_name.required"=>"品牌名称必填",
                "brand_name.unique"=>"品牌名称已存在",
                "brand_url.required"=>"品牌网址必填",
               ]);
        //文件上传
         if($request->hasFile('brand_logo')) {
            $brand_logo = upload("brand_logo");

        }
        //$brand = Brand::where("brand_id",$id)->first();
        //dd($brand);
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_url = $request->brand_url;
        if(isset($brand_logo)){
            $brand->brand_logo = $brand_logo;
        }
        $brand->brand_desc = $request->brand_desc;


        $res = $brand->save();
          //dd($res);

        if($res!==false){
          return redirect("brand/index");
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
        //$res = Db::table("brand")->where("brand_id",$id)->delete();
        $res= Brand::destroy($id);
        if($res){
            return redirect("brand/index");
        }

    }
    //验证添加名称唯一性
    public function checkname(){
        $brand_name = request()->brand_name;
        $count = Brand::where("brand_name",$brand_name)->count();
        return json_encode(["code"=>"1","count"=>$count]);
    }
     //批量删除
    public function checkdel(){
        $brand_id = request()->brand_id;
        $str = explode(",",$brand_id);
        //利用循环将需要删除的id 一个一个进行执行sql；
        foreach($str as $v){
        $deletes = Brand::where('brand_id',"=","$v")->delete();
        //return json_encode(["code"=>"1","deletes"=>$deletes]);
        }
    }
}
