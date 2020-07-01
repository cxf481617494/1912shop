<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
   	return view('add');
   	
   }
    public function adddo(){
   	 echo "提交成功";
   }
}
