<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>学生展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-bordered">
	<h2>学生展示</h2><a style="float:right;" href="{{url('student/student')}}"><button type="button" class="btn btn-success">添加</button></a>
	<thead>
		<tr>
			<th>学生id</th>
			<th>学生姓名</th>
			<th>学生性别</th>
			<th>学生年龄</th>
			<th>学生班级</th>
			<th>学生头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $v)
		<tr>
			<td>{{$v->s_id}}</td>
			<td>{{$v->s_name}}</td>
			<td>@if($v->s_sex==1)男@elseif($v->s_sex==2)女@elseif($v->s_sex==3)人妖@endif</td>
			<td>{{$v->s_age}}</td>
			<td>@if($v->s_class==1)1901 @elseif($v->s_class==2)1912 @elseif($v->s_class==3)1913 @endif</td>
			<td>@if($v->s_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->s_img}}" width="80px">@endif</td>
			<td>
				<a href="{{url('student/destroy/'.$v->s_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
				<a href="{{url('student/edit/'.$v->s_id)}}">
					<button type="button" class="btn btn-success">修改</button>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>