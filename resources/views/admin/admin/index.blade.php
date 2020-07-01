<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员展示</title>
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
<h2><b>管理员<font color=red>展示</font></b></h2><hr>
<form>
	<input type="text" name="admin_name" value="{{$admin_name}}" placeholder="管理员姓名">
	<input type="submit" value="搜索">
</form>
<table class="table table-bordered">
	
	<thead>
		<tr>
			<th><input type="checkbox" class="all">全选</th>
			<th>管理员编号</th>
			<th>管理员姓名</th>
			<th>管理员头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($admin as $v)
		<tr>
			<td><input type="checkbox" name="check" admin_id = "{{$v->admin_id}}"></td>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>@if($v->admin_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->admin_img}}" width="80px">@endif</td>
			<td>
				<a href="{{url('admin/destroy/'.$v->admin_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
				<a href="{{url('admin/edit/'.$v->admin_id)}}">
					<button type="button" class="btn btn-success">修改</button>
				</a>
			</td>
		</tr>
		@endforeach
	
	</tbody>
	
</table>
<button type="button" class="btn btn-danger" id="desplay">删除选中商品</button>
	<tr>
		<td colspan="6">{{$admin->appends(["admin_name"=>$admin_name])->links()}}</td>
	</tr>
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
		var admin_id = "";
		_check.each(function(index){
			admin_id += $(this).attr("admin_id")+",";
		})
		admin_id = admin_id.substr(0,admin_id.length-1);
			//ajax技术传给后台
			$.ajax({
				url:"checkdel",
				type:"get",
				data:{admin_id:admin_id},
				dataType:"json",
				success:function(res){
					
					
				}
			})

	})
</script>