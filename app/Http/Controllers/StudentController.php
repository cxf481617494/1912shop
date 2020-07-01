<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function lists(){
    	echo "学生列表";
    }
    public function create(Request $request){
        $method = $request->method();//查看是post还是get提交方式
        dump($method);
        if($method=="POST"){
            $Res  =  $request->all();
            dump($Res);
        }
    	return view("student");
    }
    // public function store(Request $Request){
    //     $Res  =  $Request->all();
    // 	//$sname = get();
    // 	// $sname = request("sname");
    // 	// $sclass = request("sclass");
    // 	// $sage = request("sage");
    // 	// $data = ["sname"=>$sname,"sclass"=>$sclass,"sage"=>$sage];
    // 	dump($Res);
    // }
}
