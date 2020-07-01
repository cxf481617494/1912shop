<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
      //指定表名
    protected $table = 'cate';
    //指定主键
    protected $primaryKey = 'cate_id';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
}