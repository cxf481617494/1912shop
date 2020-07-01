<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<table>
			<form action="{{url('url/update')}}" method="post">
				@csrf
				<tr>
					<td>账号</td>
					<td><input type="text" name="admin_name"></td>
					<b><font color=red>{{session('msg')}}</font></b>
				</tr>
				<tr>
					<td>密码</td>
					<td><input type="password" name="admin_pwd"></td>
				</tr>
				<tr>
					<td><input type="submit" value="登录"></td>
					<td></td>
				</tr>
			</form>
		</table>
	</center>
</body>
</html>