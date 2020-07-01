<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//闭包路由
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get("/index",function(){
// 	echo "hello";
// });
// Route::get('hello', function () {
// return 'Hello,1912';
//});
//控制器路由
//get方式("URI（地址栏）",("控制器@方法名"))
// Route::get('test','UserController@index');
// //post 方式
// Route::post('adddo','UserController@adddo');
// //练习题
// Route::get('list','StudentController@lists');
//Route::get('create','StudentController@create');
//Route::post('store','StudentController@store');

//一个路由支持多种提交方式 两种方式
//1.
//Route::any('create','StudentController@create');
//2.
//Route::match(["post","get"],'create','StudentController@create');


//301:永久重定向  302：临时重定向
//Route::redirect("/index","/create",302);
//Route::permanentRedirect("/index","/aaa");


//路由视图
//1.
//Route::view("add","student",["name"=>"飞飞"]);
//2.
// Route::get("add",function(){
// 	return view("student",["name"=>"晓飞"]);
//});
//学生路由分组管理
Route::prefix("student")->group(function(){
	//展示添加
	Route::get('student','Admin\Student\StudentController@create');
	//接收添加
	Route::post('store','Admin\Student\StudentController@store');
	//跳转展示
	Route::get("index",'Admin\Student\StudentController@index');
	//删除传参
	Route::get("destroy/{id}",'Admin\Student\StudentController@destroy');
	//展示修改
	Route::get("edit/{id}",'Admin\Student\StudentController@edit');
	//执行修改
	Route::post("update/{id}",'Admin\Student\StudentController@update');	
	});

//友情链接路由分组管理 prefix 前缀  group 分组
Route::prefix("url")->middleware("islogin")->group(function(){
	//展示添加
	Route::get('create','Admins\UrlController@create');
	//接收添加
	Route::post('store','Admins\UrlController@store');
	//跳转展示
	Route::get("index",'Admins\UrlController@index');
	//删除传参
	Route::match(['post','get'],"destroy/{id}",'Admins\UrlController@destroy');
	//ajax验证
	Route::get('checkend','Admins\UrlController@checkend');
});
	//展示登录
	Route::get('url/user','Admins\UrlController@edit');
	//执行登录
	Route::post('url/update','Admins\UrlController@update');	


//练习cookie
//存
Route::get('getcookie','CookieController@getcookie');
//取
Route::get('setcookie','CookieController@setcookie');

//域名分组管理 www.1912.com 前台  admin.1912.com  后台
Route::domain("admin.1912.com")->group(function(){
	//商品品牌路由分组管理
	Route::prefix("brand")->middleware("islogin")->group(function(){
	//展示添加
	Route::get('brand','Admin\BrandController@create');
	//接收添加
	Route::post('store','Admin\BrandController@store');
	//跳转展示
	Route::get("index",'Admin\BrandController@index');
	//删除传参
	Route::get("destroy/{id}",'Admin\BrandController@destroy');
	//展示修改
	Route::get("edit/{id}",'Admin\BrandController@edit');
	//执行修改
	Route::post("update/{id}",'Admin\BrandController@update');	
	//ajax添加验证唯一性
	Route::get("checkname",'Admin\BrandController@checkname');
	//批量删除
	Route::get("checkdel",'Admin\BrandController@checkdel');
});


//商品分类路由分组管理
Route::prefix("category")->middleware("islogin")->group(function(){
	//展示添加
	Route::get('category','Admin\categoryController@create');
	//接收添加
	Route::post('store','Admin\categoryController@store');
	//跳转展示
	Route::get("index",'Admin\categoryController@index');
	//删除传参
	Route::get("destroy/{id}",'Admin\categoryController@destroy');
	//展示修改
	Route::get("edit/{id}",'Admin\categoryController@edit');
	//执行修改
	Route::post("update/{id}",'Admin\categoryController@update');	
	//ajax验证添加唯一性
	Route::get("checkname",'Admin\categoryController@checkname');
	//批量删除
	Route::get("checkdel",'Admin\categoryController@checkdel');
});


//商品管理路由分组管理
Route::prefix("goods")->middleware("islogin")->group(function(){
	//展示添加
	Route::get('goods','Admin\GoodsController@create');
	//接收添加
	Route::post('store','Admin\GoodsController@store');
	//跳转展示
	Route::get("index",'Admin\GoodsController@index');
	//删除传参
	Route::get("destroy/{id}",'Admin\GoodsController@destroy');
	//展示修改
	Route::get("edit/{id}",'Admin\GoodsController@edit');
	//执行修改
	Route::post("update/{id}",'Admin\GoodsController@update');	
	//ajax验证添加唯一性
	Route::get("checkname",'Admin\GoodsController@checkname');
	//批量删除
	Route::get("checkdel",'Admin\GoodsController@checkdel');
});

//管理员路由分组管理
Route::prefix("admin")->middleware("islogin")->group(function(){
	//展示添加
	Route::get('admin','Admin\adminController@create');
	//接收添加
	Route::post('store','Admin\adminController@store');
	//跳转展示
	Route::get("index",'Admin\adminController@index');
	//删除传参
	Route::get("destroy/{id}",'Admin\adminController@destroy');
	//展示修改
	Route::get("edit/{id}",'Admin\adminController@edit');
	//执行修改
	Route::post("update/{id}",'Admin\adminController@update');	
	//ajax添加验证
	Route::get("checkname",'Admin\adminController@checkname');
	//批量删除
	Route::get("checkdel",'Admin\adminController@checkdel');
});


//登录路由分组管理 prefix 前缀  group 分组

	//展示登录
	Route::get('/','Admin\LoginController@create');
	//接收添加
	Route::post('login/store','Admin\LoginController@store');
	//跳转展示
	Route::get("login/index",'Admin\LoginController@index');

});

//域名分组管理 www.1912.com 前台  admin.1912.com  后台
Route::domain("www.1912.com")->group(function(){
//前台
//展示首页->middleware("islogin")
Route::get('index','Index\IndexController@index');
//展示登录
Route::get('login','Index\LoginController@login');
//执行登录
Route::post('dologin','Index\LoginController@dologin');
//展示注册
Route::get('reg','Index\LoginController@reg');
//执行注册
Route::post('regs','Index\LoginController@regs');
//执行退出
Route::match(["post","get"],'quit','Index\LoginController@quit');
//执行详情
Route::match(["post","get"],'list','Index\ProinfoController@list');
//接收首页传到详情页的id
Route::match(["post","get"],'proinfo/{id}','Index\ProinfoController@proinfo');
Route::match(["post","get"],'prolist/{id}','Index\ProinfoController@prolist');
//全部商品  最新
Route::match(["post","get"],'prolists','Index\ProinfoController@prolists');
//全部商品  最热
Route::match(["post","get"],'prolistss','Index\ProinfoController@prolistss');
//全部商品  价格
Route::match(["post","get"],'proprice','Index\ProinfoController@proprice');
//我的
Route::match(["post","get"],'user','Index\UserController@user');
//我的  待付款
Route::match(["post","get"],'order','Index\UserController@order');
//我的  优惠券
Route::match(["post","get"],'quan','Index\UserController@quan');
//我的  收货地址
Route::match(["post","get"],'addaddress','Index\UserController@addaddress');
//我的  收藏   待浏览记录
Route::match(["post","get"],'shoucang','Index\UserController@shoucang');
//我的  余额提现
Route::match(["post","get"],'tixian','Index\UserController@tixian');
//添加购物车  传id
Route::match(["post","get"],'car','Index\CarController@car');
// //展示购物车  传id
Route::match(["post","get"],'carlist','Index\CarController@carlist');
// //去结算 
Route::match(["post","get"],'pay','Index\PayController@pay');
// //去结算  总价 
Route::match(["post","get"],'getMany','Index\CarController@getMany');
// //提交订单
Route::match(["post","get"],'success','Index\PayController@ordergoods');
//购物车  传购买数量
//Route::match(["post","get"],'is_many/{id}','Index\CarController@car');
//ajax传给后台手机号验证
Route::match(['post','get'],'tele','Index\LoginController@tele');

});