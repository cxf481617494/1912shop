<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- 动态背景图 -->
    <link rel="stylesheet" href="/static/css/style2.css">
</head>
<body>
<!-- 动态背景图 -->
<div class="sky">

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

	<h2><b >商品品牌<font color=red>添加</font></b></h2>
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
<form class="form-horizontal sky" role="form" action="{{url('brand/store')}}" method="post" enctype="multipart/form-data">
	@csrf
    <div class="clouds_one"></div>
    <div class="clouds_two"></div>
    <div class="clouds_three"></div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="brand_name"
				   placeholder="请输入品牌名称">
				  <b><font color=red>{{$errors->first("brand_name")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="brand_url"
				   placeholder="请输入品牌网址">
				   <b><font color=red>{{$errors->first("brand_url")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-5">
			<input type="file" id="lastname" name="brand_logo"
				   placeholder="请输入品牌logo">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌介绍</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="lastname" name="brand_desc"
				   placeholder="请输入品牌介绍">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
    </div>
    
</form>
</body>
</html>
<script>
	//js 验证
	$(function(){
		//品牌名称
		$(document).on("blur","input[name='brand_name']",function(){
			var _this = $(this);
			var brand_name = _this.val();
			//正则
			_this.next().empty();
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(brand_name)){
				_this.next().text("品牌名称需由中文、字母、数字、下划线长度2-15位组成");
			}
			//唯一性验证
			$.ajax({
				url:"checkname",
				type:"get",
				data:{brand_name:brand_name},
				dataType:"json",
				success:function(res){
					if(res.count){
						_this.next().text("品牌名称已存在");
					}
				}
			})
		})
		//品牌网址
		$(document).on("blur","input[name='brand_url']",function(){
			var _this = $(this);
			var brand_url = _this.val();
			_this.next().empty();
			if(brand_url==""){
				_this.next().text("品牌网址不能为空");
			}
		})
		//添加按钮
		$(document).on("click","button[type='button']",function(){
			var _this = $("input[name='brand_name']");
			var brand_name = _this.val();
			//正则
			_this.next().empty();
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(brand_name)){
				_this.next().text("品牌名称需由中文、字母、数字、下划线长度2-15位组成");
			}
			var flag =  false; 
			//唯一性验证
			$.ajax({
				url:"checkname",
				type:"get",
				data:{brand_name:brand_name},
				dataType:"json",
				async:false,
				success:function(res){
					if(res.count){
						_this.next().text("品牌名称已存在");
						flag =true;
					}
				}
			})
			if(flag){
				return;
			}
			//品牌网址
			var _this = $("input[name='brand_url']");
			var brand_url = _this.val();
			_this.next().empty();
			if(brand_url==""){
				_this.next().text("品牌网址不能为空");
				return;
			}
			$("form").submit();
		})
	})


</script>