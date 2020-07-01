<?php 
//公共的方法
 //文件上传封装
    function upload($fileimg){
        $file  = request()->file($fileimg);
        if($file->isValid()){
            $path = $file->store("uploads");
            return $path;
        }
        exit("文件上传出错");
    }
/*无限极分类**/
    function CateTrue($data,$pid=0,$level=0){
        if(!$data) return;
        static $newArray = [];
        foreach($data as $v){
            if($v->pid==$pid){
                $v->level = $level;
                $newArray[] = $v;
               CateTrue($data,$v->cate_id,$level+1);
            }
        }
        return $newArray;
    }
    /*无限极分类**/
    function CateTreeArray($data,$pid=0,$level=0){
        if(!$data) return;
        static $newArray = [];
        foreach($data as $v){
            $v = $v->toArray();
            if($v['pid']==$pid){
                $v['level'] = $level;
                $newArray[] = $v;
               CateTrue($data,$v['cate_id'],$level+1);
            }
        }
        return $newArray;
    }

