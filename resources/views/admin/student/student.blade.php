<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品学生添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<h2><b>学生管理<font color=red>添加</font></b></h2><hr><a  href="{{url('student/index')}}"><button type="button" class="btn btn-success">列表</button></a>
	
<form class="form-horizontal" role="form" action="{{url('student/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生姓名</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="s_name"
				   placeholder="请输入学生姓名">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-10">
			<input type="radio" name="s_sex" value="1" checked>男
			<input type="radio" name="s_sex" value="2" >女
			<input type="radio" name="s_sex" value="3" >人妖
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生年龄</label>
		<div class="col-sm-10">
			<input type="number" id="lastname" name="s_age"
				   placeholder="请输入学生年龄">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生班级</label>
		<div class="col-sm-10">
			<select name="s_class" id="" class="col-sm-2">
				<option value="">请选择</option>
				<option value="1">1901</option>
				<option value="2">1912</option>
				<option value="3">1913</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生头像</label>
		<div class="col-sm-10">
			<input type="file"  id="lastname" name="s_img"
				   placeholder="请输入学生介绍">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<label>
					<input type="checkbox"> 请记住我
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>