@extends('index.layouts.shop')
@section('title', '注册')
@section('content')

     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('regs')}}" method="post" class="reg-login">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
          <div class="lrList">
              <input type="text" name="admin_account" placeholder="输入手机号码或者邮箱号" />
          </div>
                 <span><font color=red>{{session('msg')}}</font></span>

          <div class="lrList2">
             <input type="text" placeholder="输入短信验证码" name="admin_button"/> 
             <button type="button">获取验证码</button>
          </div>
                <span><font color=red>{{session('msge')}}</font></span>

          <div class="lrList">
             <input type="password" name="admin_pwd" placeholder="设置新密码（6-18位数字或字母）" />
          </div>

          <div class="lrList">
              <input type="password" name="admin_pwds" placeholder="再次输入密码" />
          </div>
           <span><font color=red>{{session('msgs')}}</font></span>
      </div><!--lrBox/-->
         <div class="lrSub">
             <input type="button" value="立即注册" />
         </div>
     </form><!--reg-login/-->
<script>
  $(function(){
    $(document).on("click","button",function(){
      var tele = $("input[name='admin_account']").val();
      $.ajax({
        url:"tele",
        type:"get",
        data:{tele:tele},
        dataType:"json",
        success:function(res){
          if(res.code=="00000"){
            alert(res.msg);
          } 
          if(res.code=="11111"){
            alert(res.msg);
          }
        }
      })
    })
  })
  $(document).on("click","input[type='button']",function(){
    var admin_account = $("input[name='admin_account']").val();
    if(!admin_account){
      alert("请输入手机号或者邮箱");return;
    }
     var admin_button= $("input[name='admin_button']").val();
    if(!admin_button){
      alert("请输入验证码");return;
    }
     var reg = /^[0-9,a-z,A-Z]{6,18}$/;
     var admin_pwd = $("input[name='admin_pwd']").val();
    if(!admin_pwd){
      alert("请输入密码");return;
    }else if(!reg.test(admin_pwd)){
      alert("密码长度在6-18位，数字或字母");return;
    }
     var admin_pwds = $("input[name='admin_pwds']").val();
    if(admin_pwd!==admin_pwds){
      alert("两次密码输入有误");return;
    }
    $("form").submit();
  })


</script>
@endsection
