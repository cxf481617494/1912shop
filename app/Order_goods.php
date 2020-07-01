<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_goods extends Model
{
    protected $table = "shop_order_goods";
    protected $primaryKey = 'id';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
}
