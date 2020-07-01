<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = "url";
    protected $primaryKey = 'url_id';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
}
