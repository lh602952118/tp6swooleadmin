<?php
// 应用公共文件
error_reporting(E_ERROR | E_PARSE);
/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取根目录相对路径
 * Param:
 * Return:
 * Data: 2019/11/21 9:45
 */
function getPublicPath()
{
    return config("util.public_path");
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取后台登陆用户的session名称
 * Param:
 * Return:
 * Data: 2019/11/21 9:45
 */
function getUserSessionName()
{
    return config("util.user_session");
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取后台用户登录超时时间
 * Param:
 * Return:
 * Data: 2019/11/21 9:47
 */
function getEnOutTime()
{
    return config("util.login_out_time");
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取红色星号
 * Param:
 * Return:
 * Data: 2019/8/27 11:20
 */
function getImportant()
{
    return '<span style="color: red;font-weight: bold;"> * </span>';
}

function getPageLimite()
{
    return config("util.admin_page");
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取自定义ID
 * Param:
 * Return:
 * Data: 2019/8/27 11:20
 */
function getChuanMa($tou = "SN")
{
    static $guid = '';
    $uid = uniqid("", true);
    $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= "36548545522";
    $data .= "AKDIIIOOEJLSSDFGV";
    $data .= "NMAMTF";
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = substr($hash, 0, 3) .
        substr($hash, 8, 3) .
        substr($hash, 12, 3) .
        substr($hash, 16, 3) .
        substr($hash, 20, 3);
    return $tou . $guid;
//        .rand(100,999);
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取验证码
 * Param:
 * Return:
 * Data: 2019/11/25 16:19
 */
function getCapture()
{
    return \think\captcha\facade\Captcha::create("captcha");
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc:  获取IP地址
 * Param:
 * Return:
 * Data: 2019/11/25 16:18
 */
function getIP()
{
    global $ip;

    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else
        $ip = "Unknow";

    return $ip;
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取用户数据
 * Param:
 * Return:
 * Data: 2019/11/25 16:14
 */
function getCurUserItem($file)
{
    $user = session(getUserSessionName());
    return $user[$file];
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取菜单地址
 * Param:
 * Return:
 * Data: 2019/11/25 17:13
 */
function getMenuUrl($menu)
{
    $url = getPublicPath() . "admin/";
    if ($menu["controller"] != "") {
        $url .= $menu["controller"] . "/";
    } else {
        $url .= "index/";
    }
    if ($menu["method"] != "") {
        $url .= $menu["method"] . ".html";
    } else {
        $url .= "index.html";
    }
    return $url;
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取菜单
 * Param:
 * Return:
 * Data: 2019/11/26 10:56
 */
function getPMenus()
{
    $ones = \app\admin\model\Mainmenu::where("level", 1)->order("sort", "asc")->select();
    $o = [];
    foreach ($ones as $one) {
        $twos = app\admin\model\Mainmenu::where("pid", $one["id"])->order("sort", "asc")->select();
        $t = [];
        foreach ($twos as $two) {
            $third = app\admin\model\Mainmenu::where("pid", $two["id"])->order("sort", "asc")->select();
            $two["sons"] = $third;
            $t[] = $two;
        }
        $one["sons"] = $t;
        $one["name"] = $one["name"];
        $o[] = $one;
    }
    return $o;
}

function getCurTime()
{
    return time();
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 将数组里的所有字段的值都做去空格trim操作
 * Param:
 * Return:
 * Data: 2019/10/12 11:37
 */
function repemp($arr)
{
    $re = [];
    foreach ($arr as $key => $val) {
        $re[$key] = trim($val);
    }
    return $re;
}

function errorlog($name, $content)
{
    \app\admin\model\UserLog::saveLog($name == "" ? "无标题" : $name, $content == "" ? "无内容" : $content);
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取级别名称
 * Param:
 * Return:
 * Data: 2019/11/27 10:09
 */
function getLevelName($key)
{
    $re = "";
    switch ($key) {
        case 0:
            $re = "特殊";
            break;
        case 1:
            $re = "一级";
            break;
        case 2:
            $re = "二级";
            break;
        case 3:
            $re = "三级";
            break;
        default:
            break;
    }
    return $re;
}

function getMenuName($id)
{
    $menu = \app\admin\model\Mainmenu::where("id", $id)->find();
    if ($menu["id"] != "") {
        return $menu["name"];
    } else {
        return "";
    }
}

function getMenuShow($key)
{
    $re = "";
    switch ($key) {
        case 1:
            $re = "显示";
            break;
        case 2:
            $re = "隐藏";
            break;
        default:
            break;
    }
    return $re;
}

function getBase64Decode($str)
{
    if ($str) {
        return base64_decode($str);
    }
}

function hasson($id)
{
    $has = \app\admin\model\Mainmenu::where("pid", $id)->find();
    if ($has["id"]){
        return 1;
    }
}
/**
   * Author: MrLi (602952118@qq.com)
   * Desc: 获取权限列表
   * Param:
   * Return:
   * Data: 2019/12/2 11:07
 */
function getPowerMenus(){
    $powers = \app\admin\model\Mainmenu::getPowerMenus();
    return $powers;
}

/**
 * Author: MrLi (602952118@qq.com)
 * Desc: 获取权限列表特殊权限
 * Param:
 * Return:
 * Data: 2019/12/2 11:07
 */
function getSpPowerMenus(){
    $powers = \app\admin\model\Mainmenu::getSpPowerMenus();
    return $powers;
}
/**
   * Author: MrLi (602952118@qq.com)
   * Desc: 获取权限列表
   * Param:
   * Return:
   * Data: 2019/12/2 15:01
 */
function getPowers(){
    return \app\admin\model\UserPower::order("level","asc")->select();
}
/**
   * Author: MrLi (602952118@qq.com)
   * Desc: 获取权限名称
   * Param:
   * Return:
   * Data: 2019/12/2 16:56
 */
function getPowerName($id){
    $p = \app\admin\model\UserPower::where("id",$id)->field("name")->find();
    return $p["name"];
}

function getUserStatus($key){
    switch ($key) {
        case 1:
            return "启用";
            break;
        case 2:
            return "<span style='color:red'>停用</span>";
            break;
        default:

            break;
    }
}