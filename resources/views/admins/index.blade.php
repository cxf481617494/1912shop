<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>友情链接展示</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
	<!-- ajax令牌 -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
	<h2><b>友情链接<font color=red>展示</font></b></h2><hr><a href="{{url('url/user')}}">登录</a>
<!--  -->
<form>
	<input type="text" name="url_name" placeholder="请输入网站名称" value="{{$url_name}}">
	<input type="submit" value="搜索">
</form>
<table class="table table-bordered">
	
	<thead>
		<tr>
			<th><input type="checkbox">&nbsp;&nbsp;&nbsp;商品编号</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>文章图片</th>
			<th>是否显示</th>
			<th>添加日期</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($url as $v)
		<tr>

			<td><input type="checkbox">&nbsp;&nbsp;&nbsp;{{$v->url_id}}</td>
			<td>{{$v->url_name}}</td>
			<td>{{$v->cate_name}}</td>
			<td>@if($v->url_new==1)普通@elseif($v->url_new==2)置顶@endif</td>
			<td>@if($v->url_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->url_img}}" width="80px">@endif
			</td>
			<td>@if($v->url_hot==1)√@elseif($v->url_hot==2)×@endif</td>
			<td>{{date("Y-m-d H:i:s",$v->url_time)}}</td>
			<td>
			<button class="btn btn-success"><a  href="javascript:;" class="del" url_id="{{$v->url_id}}"><font color="red">删除</font></a></button>

				<a href="{{url('goods/edit/'.$v->goods_id)}}">
					<button type="button" class="btn btn-success">修改</button>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
	
</table>
	<tr>
		<td colspan="10">{{$url->appends(["url_name"=>$url_name])->links()}}</td>
	</tr>
</body>
</html>
<!-- ajax删除 -->
<!-- 第一种get方式传输 -->
<script>
	// $(function(){
	// 	$(document).on("click",".del",function(){
	// 		var url_id = $(this).attr("url_id");
	// 		//alert(bid);
	// 		if(confirm("您确定删除吗")){
	// 			$.get("destroy/"+url_id,function(res){
	// 				if(res.code=='1'){
	// 					location.reload();
	// 				}
	// 			},'json')
	// 		}
	// 	})
	// })
//第二种post方式传输 手册第218页
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
$(function(){
		$(document).on("click",".del",function(){
			var url_id = $(this).attr("url_id");
			//alert(bid);
			if(confirm("您确定删除吗")){
				$.post("destroy/"+url_id,function(res){
					if(res.code=='1'){
						location.reload();
					}
				},'json') //dataType:"json"
			}
		})
	})




</script>