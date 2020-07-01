<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//调用手机号
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
//邮件门面
use Illuminate\Support\Facades\Mail;
//引入邮寄类
use App\Mail\sendcode;
//引入注册登录表
use App\Shop_admin;

// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md


class LoginController extends Controller
{
    //展示登录
    public function login(){
    	//dd(encrypt(123123));
    	return view("index/login");
    }
    //执行登录
    public function dologin(Request $request){
         $post = $request->all();
        //dd($post);
        $admin = Shop_admin::where("admin_account",$post["admin_account"])->first();
        //判断账号是否存在
        if(!$admin){
            return redirect("login")->with("msg","用户名或密码错误");
        }
        //如果存在解密密码 如果密码错误 给出提示
        if(decrypt($admin->admin_pwd)!=$post["admin_pwd"]){
            return redirect("login")->with("msge","用户名或密码错误");
        }
        //存session
        request()->session()->put("admin",$admin);
        return redirect("index");
    }
    //展示注册
    public function reg(){
    	return view("index/reg");
    }
    //执行注册
    public function regs(){
      $shop_admin = new Shop_Admin;
      $shop_admin->admin_account = request()->admin_account;
      $shop_admin->admin_pwd = request()->admin_pwd;
      //获取确认密码和密码
      $admin_pwds = request()->admin_pwds;
      if($admin_pwds!=$shop_admin['admin_pwd']){
         return redirect("reg")->with("msgs","两次密码输入错误");
      }
      //取邮箱或者手机号
      $res = request()->session()->get("tele");
      if($shop_admin['admin_account']!=$res){
          //dd("手机号不正确");
          return redirect("reg")->with("msg","手机号或邮箱输入不正确");
      }
      //取验证码
      $admin_button = request()->admin_button;
      $res1 = request()->session()->get("code");
      if($admin_button!=$res1){
          return redirect("reg")->with("msge","验证码不正确");
      }
      //验证账号是否存在唯一性验证
      // $admin_account = request()->admin_account;
      // $sss = Shop_Admin::where($shop_admin['admin_account'],"=",$admin_account)->count();
      // dump($sss);
      //数据迁移
      //密码加密
      $shop_admin['admin_pwd'] = encrypt($shop_admin['admin_pwd']);
      //dd($shop_admin);
      //入库 对数据入框
      $_tele = '/^1[368][0-9]{9}$/';
      $_email = '/^\w{5,}@(qq|163|sina)(\.)(com|cn|net)$/';
      if(preg_match($_tele,$shop_admin['admin_account'])){
        $shop_admin["admin_moblie"] = $shop_admin['admin_account'];
      }else if(preg_match($_email,$shop_admin['admin_account'])){
        $shop_admin["admin_email"] = $shop_admin['admin_account'];
      }else{
        return redirect("reg")->with("msg","手机号或邮箱输入不正确");
      }
      $res = $shop_admin->save();
      if($res){
        return redirect("login");
      }
    }
    //AccessKey ID : LTAI4GJRwmSVN2HXCatjKf1e
    //SECRET       : NIAZcaVB4nOuiKcimP2R8i2czrUQe9
    //SMS_190274187
    //黑珍珠奶茶
    //cn-hangzhou
    //接传来的手机号值
    public function tele(){
    	$tele = request()->tele;
      //生成验证码
      $code = rand(1000,9999);
    	$_tele = '/^1[368][0-9]{9}$/';
      $_email = '/^\w{5,}@(qq|163|sina)(\.)(com|cn|net)$/';
     	if(preg_match($_tele,$tele)){
            //手机发送验证码
           $res= $this->sendSms($tele,$code);
           if($res['Message']=='OK'){
              session(["code"=>$code,"tele"=>$tele]);
                return json_encode(['code'=>'00000','msg'=>'发送成功']);
            }
      }else if(preg_match($_email,$tele)){
        //邮箱发送验证码
           $aaa = $this->sendmail($tele,$code);
            session(["code"=>$code,"tele"=>$tele]);
             return json_encode(['code'=>'00000','msg'=>'发送成功']);
      }else{
            return json_encode(['code'=>'00000','msg'=>'输入正确的手机号或邮箱']);
           }
    }
    //调用手机号
    public function sendsms($mobile,$code){
        AlibabaCloud::accessKeyClient('LTAI4GJRwmSVN2HXCatjKf1e', 'NIAZcaVB4nOuiKcimP2R8i2czrUQe9')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => $mobile,
                                                'SignName' => "黑珍珠奶茶",
                                                'TemplateCode' => "SMS_190274187",
                                                'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }
    }
    //调用邮箱
    public function sendmail($tele,$code){
       return  Mail::to($tele)->send(new sendcode($code));
    }
    //退出、
    public function quit(){
     $res = request()->session()->forget("admin");
     return redirect("index");
    } 

}
