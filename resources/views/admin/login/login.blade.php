<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>登录</title>
<link rel="stylesheet" type="text/css" href="/static/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/static/css/demo.css" />

<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/static/css/component.css" />
<!-- // --><link rel="stylesheet" type="text/css" href="/static/image/demo-1-bg.jpg" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
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
		<div class="alert alert-danger"></div>
<div class="container demo-1">
	<div class="content">
		<div id="large-header" class="large-header">
			<canvas id="demo-canvas"></canvas>
			<div class="logo_box">
				<h3>微商城后台登陆</h3>
				<form action="{{url('login/store')}}" name="f" method="post">
					@csrf
					<div class="input_outer">
						<span class="u_user"></span>
						<input name="admin_name" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b><font color=red>{{session('msg')}}</font></b>
					</div>
					<div class="input_outer">
						<span class="us_uer"></span>
						<input name="admin_pwd" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
					</div>	&nbsp;&nbsp;
					<input name="rember" type="checkbox" />
    					<span>七天免登录</span>
					
				
					<button class="act-but submit" type="submit" style="color: #FFFFFF">登录</button>
					<!-- <input  class="act-but submit"  style="color: #FFFFFF" value="登录"> -->
					
				</form>
			</div>
		</div>
	</div>
</div><!-- /container -->
		<script src="/static/js/TweenLite.min.js"></script>
		<script src="/static/js/EasePack.min.js"></script>
		<script src="/static/js/rAF.js"></script>
		<script src="/static/js/demo-1.js"></script>
	</body>
</html>