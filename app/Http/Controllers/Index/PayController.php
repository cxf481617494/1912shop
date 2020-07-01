<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Car;
use App\Order;
use App\Order_goods;
class PayController extends Controller
{
        //去结算
    public function pay(){
    	$goods_id = request()->goods_id;
    	// echo $goods_id;
    	$goods_id = explode(",",$goods_id);
  		$Goods = Car::whereIn("goods_id",$goods_id)->get();
      //dd($Goods);
      //$goo_id = $Goods->toArray();
      //$gg_id = $goo_id["goods_id"];
  		//dump($goo_id);
      return view("index.pay",["Goods"=>$Goods]);
    }
    // //提交订单商品表
    public function ordergoods(){
        $goods_id = request()->goods_id;
        $goods_id = explode(",",$goods_id);
       //$Goods = Car::select("goods_id","goods_name","goods_price","goods_img","is_many")->find($goods_id);
        $Goods = Car::whereIn("goods_id",$goods_id)->get();
        //$Goods = array_column($Goods,"goods_name","goods_id");
        // foreach($Goods as $k=>$V){
        //   $Goods["goods_id"] = array_column($Goods,"goods_id");
        // }
//         foreach($Goods as $k => $v){
// 　　　　$Goods[$v] = $Goods["goods_id"];
//         }
        //$Goods = implode(",",$Goods);
       //dd($Goods);
        // $res = Car::->find($goods_id)->toArray();
        // $aa = $res->toArray();
         //$aa = $res["goods_price"];
        //dd($Goods); 
       $order_goods  = new Order_goods;
        $data = [
               "goods_name"=>$Goods["goods_name"],
               "goods_id"=>$Goods["goods_id"],
               "goods_price"=>$Goods["goods_price"],
               "goods_img"=>$Goods["goods_img"],
               "is_many"=>$Goods["is_many"],
              ];
               $arr = ['goods_id'=>$Goods];
               // dd($arr);




       
        // $res = $order_goods->insert($data);
        // dd($res);
    }
    //提交订单
    public function success(){
    //   $orderInfo = Car::all();
    //   // dd($orderInfo);
    //   // 生成随机的订单号
    //   $order_no = rand(10,99).date('ymdhis').rand(100,999);
    //   // $order_on = rand(10,99).date('ymdhis').rand(100,999);
    //   // dd($order_on);
    //   return view("index.success",['orderInfo'=>$orderInfo,'order_no'=>$order_no]);
     }
}
