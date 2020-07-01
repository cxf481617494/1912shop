<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类添加</title>
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
	<h2><b>商品分类<font color=red>添加</font></b></h2><hr>
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
<form class="form-horizontal sky" role="form" action="{{url('category/store')}}" method="post">
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
				<option value="{{$v->cate_id}}">{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
			<b><font color=red>{{$errors->first("pid")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否展示</label>
		<div class="col-sm-5">
			<input type="radio" name="cate_show" value="1" checked>是
			<input type="radio" name="cate_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否导航栏展示</label>
		<div class="col-sm-5">
			<input type="radio" name="cate_nav_show" value="1" checked>是
			<input type="radio" name="cate_nav_show" value="2">否
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
		
		//名称验证
		$(document).on("blur","input[name='cate_name']",function(){
			var _this = $(this);
			var brand_name = _this.val();
			_this.next().empty();
			//js验证是否符合规则
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(brand_name)){
				_this.next().text("分类名称需由中文、字母、数字、下划线长度2-15位组成");
			}
			//唯一性验证
			$.ajax({
				url:"checkname",
				type:"get",
				data:{brand_name:brand_name},
				async:false,
				dataType:"json",
				success:function(res){
					if(res.count){
						_this.next().text("分类名称已存在");
					}
				}
			})
		})
		//顶级分类验证
		$(document).on("change","select[name='pid']",function(){
			var pid = $(this).val();
			$(this).next().empty();
			if(pid==""){
				$(this).next().text("顶级分类不能为空");
			}
		})
		//按钮验证
		$(document).on("click","button[type='button']",function(){
			var _this = $("input[name='cate_name']");
			var brand_name = _this.val();
			_this.next().empty();
			//js验证是否符合规则
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(brand_name)){
				_this.next().text("分类名称需由中文、字母、数字、下划线长度2-15位组成");return;
			}
			//唯一性验证
			$.ajax({
				url:"checkname",
				type:"get",
				data:{brand_name:brand_name},
				dataType:"json",
				async:false,
				success:function(res){
					if(res.count){
						_this.next().text("分类名称已存在");return;
					}
				}
			})
			var pid = $("select[name='pid']").val();
			$(this).next().empty();
			if(pid==""){
				$(this).next().text("顶级分类不能为空");
			}
			$("form").submit();
		})
		
	})




</script>