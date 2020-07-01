<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类修改</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
	<!-- 动态背景图 -->
    <link rel="stylesheet" href="/static/css/style2.css">
</head>
<body>
	<!-- 动态背景图 -->
<div class="sky">
	
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{url('login/index')}}">微商城</a>
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
	<h2><b>商品分类<font color=red>修改</font></b></h2><hr>
	<!-- 表单提示错误信息 手册第321页-322页-->
		<!-- @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif -->
<form class="form-horizontal sky" role="form" action="{{url('category/update/'.$categorys->cate_id)}}" method="post">
	@csrf
		<!-- 动态背景图 -->
	<div class="clouds_one"></div>
    <div class="clouds_two"></div>
    <div class="clouds_three"></div>
    <!-- 动态背景图 -->
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="cate_name"
			value="{{$categorys->cate_name}}"
				   placeholder="请输入分类名称">
				    <b><font color=red>{{$errors->first("cate_name")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">顶级分类</label>
		<div class="col-sm-5">
			<select name="pid" id="" class="col-sm-3">
				<option value="">请选择</option>
				@foreach($category as $v)
				<option value="{{$v->cate_id}}" @if($categorys->pid) selected="selected" @endif>{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</option>			
				@endforeach
				
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否展示</label>
		<div class="col-sm-5">
			<input type="radio" name="cate_show"@if($categorys->cate_show==1) checked="checked" @endif value="1">是
			<input type="radio" name="cate_show"@if($categorys->cate_show==2) checked="checked" @endif value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否导航栏展示</label>
		<div class="col-sm-5">
			<input type="radio" name="cate_nav_show"@if($categorys->cate_nav_show==1) checked="checked" @endif  value="1">是
			<input type="radio" name="cate_nav_show"@if($categorys->cate_nav_show==2) checked="checked" @endif  value="2">否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</div>
</form>
</body>
</html>