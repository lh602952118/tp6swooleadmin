<?php
namespace app\admin\controller;

use app\admin\model\UserLog;
use app\admin\model\Users;
use app\admin\validate\User;
use app\BaseController;
use app\common\lib\Redis;
use app\common\lib\Util;
use think\captcha\facade\Captcha;
use think\exception\ValidateException;

class Login extends BaseController
{
    public function index()
    {
       return view("index");

    }
    function login(){
        $in = input();
        $username = $in["username"];
        $password = $in["password"];
        if(!captcha_check($in["verify"])){
            return Util::getReturn(config("code.error"),"验证码输入错误，请点击刷新后重新输入");
        }
        try {
            validate(User::class)->check($in);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return Util::getReturn(config("code.error"),$e->getError());
        }
        //验证用户
        $user = Users::where("username",$username)->where("password",md5($password))->findOrEmpty();
        if($user->isEmpty()){
            return Util::getReturn(config("code.error"),"无此用户，或密码错误");
        }
        if($user["is_use"] == 2){
            return Util::getReturn(config("code.error"),"该账号已暂停使用");
        }
        if($user["is_del"] == 2){
            return Util::getReturn(config("code.error"),"无此用户，或密码错误");
        }
        $user["password"] = "";
        session(getUserSessionName(),$user);
//        UserLog::saveLog("session",getUserSessionName());
        return Util::getReturn(config("code.success"),"登陆成功");
    }

}
