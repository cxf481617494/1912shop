<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>友情链接添加</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{url('url/create')}}">友情链接添加</a>
		<a class="navbar-brand" href="{{url('url/index')}}">友情链接展示</a>
	</div>
	</div>
</nav>
	<h2><b>友情链接<font color=red>添加</font></b></h2><hr>
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
<form class="form-horizontal sky" role="form" action="{{url('url/store')}}" method="post" enctype="multipart/form-data">
	@csrf

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label><span><font color=red>*</font></span>
		
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="url_name"
				   placeholder="请输入文章标题" >
				   <b><font color=red>{{$errors->first("url_name")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label><span><font color=red>*</font></span>
		<div class="col-sm-5">
			<select name="url_cate" id="">
				<option value="">请选择</option>
				@foreach($cate as $v)
				<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
				@endforeach
			</select>
				   <b><font color=red>{{$errors->first("url_cate")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label><span><font color=red>*</font></span>
		<div class="col-sm-5">
			<input type="radio" name="url_new" value="1" checked>普通
			<input type="radio" name="url_new" value="2">置顶
				<b><font color=red>{{$errors->first("url_new")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label><span><font color=red>*</font></span>
		<div class="col-sm-5">
			<input type="radio" name="url_hot" value="1" checked>显示
			<input type="radio" name="url_hot" value="2">不显示
				<b><font color=red>{{$errors->first("gurl_hot")}}</font></b>
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="url_mans"
				   placeholder="请输入文章作者">
				   <b><font color=red>{{$errors->first("url_mans")}}</font></b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="url_email"
				   placeholder="请输入作者Email">
				   <!-- <b><font color=red>{{$errors->first("goods_score")}}</font></b> -->
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="firstname" name="url_nas"
				   placeholder="请输入关键字">
				   <!-- <b><font color=red>{{$errors->first("goods_score")}}</font></b> -->
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站介绍</label>
		<div class="col-sm-5">
			<textarea class="form-control" rows="3" name="url_desc"  placeholder="请输入网站介绍"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-5">

			<input type="file"  id="firstname" name="url_img">
				   <!-- <b><font color=red>{{$errors->first("goods_num")}}</font></b> -->
		</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			<button type="button" class="btn btn-default">添加</button>
			<button type="submit" class="btn btn-default">取消</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$(function(){
		//文章标题
		$(document).on("blur","input[name='url_name']",function(){
			var _this = $(this);
			_this.next().empty();
			var url_name = _this.val();
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(url_name)){
				_this.next().text("文章标题格式不符合");return;
			}
			//唯一性验证
			$.ajax({
				url:"{{url('url/checkend')}}",
				type:"get",
				data:{url_name:url_name},
				dataType:"json",
				success:function(res){
					if(res.count){
						_this.next().text("文章标题已存在");
					}
				}
			})
		});
		//文章作者
		$(document).on("blur","input[name='url_mans']",function(){
			var _this = $(this);
			 _this.next().empty();
			var url_mans = _this.val();
			if(url_mans==""){
				_this.next().text("文章作者不能为空");
				return;
			}
		})
		//添加按钮
		$(document).on("click","button[type='button']",function(){
			var _this = $("input[name='url_name']");
			_this.next().empty();
			var url_name = _this.val();
			var reg = /^[\u4e00-\u9fa5\w]{2,15}$/;
			if(!reg.test(url_name)){
				_this.next().text("文章标题格式不符合");return;
			}
			var flag = false;
			//唯一性验证
			$.ajax({
				url:"{{url('url/checkend')}}",
				type:"get",
				data:{url_name:url_name},
				dataType:"json",
				async:false,
				success:function(res){
					if(res.count){
						_this.next().text("文章标题已存在");
						flag = true;
					}
				}
			})
			if(flag){
				return;
			}
			//文章作者
			var _this = $("input[name='url_mans']");
			 _this.next().empty();
			 var url_mans = _this.val();
			 if(url_mans==""){
				_this.next().text("文章作者不能为空");
				return;
			}
			//提交表单
			$("form").submit();
		})

	})




</script>