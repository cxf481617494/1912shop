<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<title>微商城首页</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/static/css/style.css">


<link rel="stylesheet" media="screen" href="/static/css/login.css">
<!-- 背景特效 -->
<!-- particles.js container -->
		<div id="particles-js" style="display: flex;align-items: center;justify-content: center">
			<canvas class="particles-js-canvas-el" style="width: 100%; height: 100%;" width="472" height="625"></canvas>
		</div>
<!-- 文字跳动 -->
<!-- <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet"> -->
<link rel="stylesheet" href="/static/css/style1.css">
</head>
<body>
  <div class="content-left">
            <!--<img src="images/d.png" alt="">-->
        </div>
<div class="rotating-text">
	<p>欢迎<font color=red>{{$res->admin_name}}</font>登录</p>
	<span class="letter">微</span>
	<span class="letter"><font color=pink>商</font></span>
	<span class="letter">城</span>
</div>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
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
<script  src="js/script.js"></script>

</body>
</html>
<!-- 背景特效 -->
<!-- scripts -->
		<script src="/static/js/login.js"></script>
		<script src="/static/js/loginApp.js"></script>
		<script>
			function changeImg() {
				let pic = document.getElementById('picture');
				console.log(pic.src)
				if (pic.getAttribute("src", 2) == "img/check.png") {
					pic.src = "img/checked.png"
				} else {
					pic.src = "img/check.png"
				}
			}
		</script>
