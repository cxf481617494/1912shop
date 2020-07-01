<?php

namespace App\Http\Controllers\admin\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::table("student")->get();
        //dd($res);
         return view("admin/student/index",["res"=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/student/student");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $student = $request->except("_token");
        //文件上传
        if($request->hasFile('s_img')) {
            $student["s_img"] = $this->upload("s_img");
        }
        $res = DB::table("student")->insert($student);
        if($res){
            return redirect("student/index");
        }
        
    }
    //文件上传封装
    public function upload($fileimg){
        $file  = request()->file($fileimg);
        if($file->isValid()){
            $path = $file->store("uploads");
            return $path;
        }
        exit("文件上传出错");
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
        $res = DB::table("student")->where("s_id",$id)->first();
        return view("admin/student/edit",["res"=>$res]);
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
        
        $student = $request->except("_token");
        $res = DB::table("student")->where("s_id",$id)->update($student);
        if($res){
            return redirect("student/index");
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
        $res = DB::table("student")->where("s_id",$id)->delete();
         if($res){
            return redirect("student/index");
        }
    }
}
