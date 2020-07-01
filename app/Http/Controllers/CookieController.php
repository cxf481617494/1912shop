<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate \Support\Facades\Cookie;
class CookieController extends Controller
{
	//存cookie
    public function getcookie(){
    	//第一种
    	//return response("1912 hello")->cookie("user","陈晓飞",2);
    	//第二种
    	//Cookie::queue(Cookie::make("user","晓飞", 2));
    	//第三种
    	Cookie::queue("user","张三",2);
    }
    //取cookie
    public function setcookie(Request $request){
    	//第一种
    	dd($request->cookie('user'));
    	//第二种
    	dd(Cookie::get('user'));
    }
}
