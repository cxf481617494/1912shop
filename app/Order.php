<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "shop_order";
    protected $primaryKey = 'order_id';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
}
