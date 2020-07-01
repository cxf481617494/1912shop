<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类展示</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="#">微商城</a>
	</div>
	<div>
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					商品品牌
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li class="divider"></li>
					<li><a href="{{url('brand/brand')}}">商品品牌添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('brand/index')}}">商品品牌展示</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					商品分类
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li class="divider"></li>
					<li><a href="{{url('category/category')}}">商品分类添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('category/index')}}">商品分类展示</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					商品
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li class="divider"></li>
					<li><a href="{{url('goods/goods')}}">商品添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('goods/index')}}">商品展示</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					管理员
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li class="divider"></li>
					<li><a href="{{url('admin/admin')}}">管理员添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('admin/index')}}">管理员展示</a></li>
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>

<table class="table table-bordered">
	<h2><b>商品分类<font color=red>展示</font></b></h2><hr>
	<thead>
		<tr>
			<th><input type="checkbox" class="all">全选</th>
			<th>商品分类编号</th>
			<th>商品分类名称</th>
			<th>商品是否上架</th>
			<th>商品在导航栏显示</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($category as $v)
		<tr>
			<td><input type="checkbox" name="check" cate_id = "{{$v->cate_id}}"></td>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat("~-~-",$v->level)}}{{$v->cate_name}}</td>
			<td>@if($v->cate_show==1)是@elseif($v->cate_show==2)否@endif</td>
			<td>@if($v->cate_nav_show==1)是@elseif($v->cate_nav_show==2)否@endif</td>
			<td>
				<a href="{{url('category/destroy/'.$v->cate_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
				<a href="{{url('category/edit/'.$v->cate_id)}}">
					<button type="button" class="btn btn-success">修改</button>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<button type="button" class="btn btn-danger" id="desplay">删除选中商品</button>
</body>
</html>
<script>
	//当点击设置好的class
	$('.all').click(function(){
		if (this.checked) { //this指当前对象
            $("[name=check]:checkbox").prop("checked", true); 
        }else{
            $("[name=check]:checkbox").prop("checked", false);
        }	
	})
	//批量删除
	$(document).on("click","#desplay",function(){
		var _this = $(this);
		var deletes = $(this);
		var _check = $("input[name='check']:checked");//获取选中的复选框
		if(_check.length==0){
			alert("请至少选中一条进行删除");return;
		}
		var cate_id = "";
		_check.each(function(index){
			cate_id += $(this).attr("cate_id")+",";
		})
		cate_id = cate_id.substr(0,cate_id.length-1);
			//ajax技术传给后台
			$.ajax({
				url:"checkdel",
				type:"get",
				data:{cate_id:cate_id},
				dataType:"json",
				success:function(res){
					
					
				}
			})

	})
</script>