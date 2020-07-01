<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
     //指定表名
    protected $table = 'admin';
    //指定主键
    protected $primaryKey = 'admin_id';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
}
