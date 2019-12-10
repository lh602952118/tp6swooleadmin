<?php
/**
 * 2017年9月26日
 * 后台控制器 包含权限管理
 * @author 李桦
 */

namespace app\common\controller;

<<<<<<< HEAD
use app\admin\model\Mainmenu;
use think\App;
=======
>>>>>>> 7ddf4b56fa75f25b9e4e1a557868f5e04d49a1d4
use think\facade\Session;

class HController extends SController
{
<<<<<<< HEAD

    protected $userinfo = [];
    protected $adminId = '';

    function __construct(App $app)
    {
        parent::__construct($app);


        $usersession = Session::get(getUserSessionName());
        if ($usersession != null) {
            $distime = getEnOutTime();
            $this->assign("username", $usersession ["username"]);
            if ($usersession ["outtime"] != "") {
                if ($usersession ["outtime"] < time()) {
                    $this->loginout("登录已超时，请重新登录");
                } else {
=======
    protected $userinfo = [];
    function __construct($app)
    {
        parent::__construct($app);
        $usersession = Session::get(USERSESSIONNAME);
        if ($usersession != null) {
            $distime = 7200;
            $this->assign("username", $usersession ["username"]);
            if ($usersession ["outtime"] != "") {
                if ($usersession ["outtime"] < time()) {
                    $this->loginout("登录时间已超出，请重新登录。");
                }else{
>>>>>>> 7ddf4b56fa75f25b9e4e1a557868f5e04d49a1d4
                    $usersession ["outtime"] = time() + $distime;
                }
            } else {
                $usersession ["outtime"] = time() + $distime;
<<<<<<< HEAD
                Session::get(getUserSessionName(), $usersession);
            }
            \think\facade\Request::withGet(array_merge(\think\facade\Request::get(), ["adminId" => $usersession["id"]]));
            $this->userinfo = $usersession;
            $this->adminId = $usersession["id"];
            $this->mainMenu();
        } else {
            $this->loginout("请您先登录");
        }

    }

    private function getInfo($info)
    {
        return "<div style='color:#2ED62E;width:100%;text-align:center;'>" . $info . "</div>";
    }

    private function mainMenu()
    {
        $menu = Mainmenu::getPowerMenus2($this->adminId);
        $this->assign("menu", $menu);
    }

    function loginout($info = "")
    {
        Session::set(getUserSessionName(), null);
        Session::set("login_info", null);
        if ($info != "") {
            Session::set("login_info", $info);
        }
//        return redirect((string)url("losdfsdfgin/index"))->with("login_info",$info);
        echo "<script>window.top.location.href='" . url('login/index') . "?" . getChuanMa("R") . "';</script>";
    }

    function loginout1($info = "")
    {
        Session::set(getUserSessionName(), null);
        Session::set("login_info", null);
        if ($info != "") {
            Session::set("login_info", $info);
        }
//        return redirect((string)url("losdfsdfgin/index"))->with("login_info",$info);
        echo "<script>window.top.location.href='" . url('login/index') . "?" . getChuanMa("R") . "';</script>";
=======
                Session::set(USERSESSIONNAME, $usersession);
            }
        } else {
            $this->loginout("请您先登录。");
        }

        $this->checkuserpowermenu();
        $power = Session::get(USERSESSIONNAME)["uslevel"];
        if ($power != 10 and $power != 100) {
            $this->assign("lmenu", $this->getUserPowerView()->getPowerMenu());
        } else {
            $this->assign("lmenu", $this->getApowertype()->getAll());
        }

        $this->assign("usernums", $this->getUsers()->getUserNums());

        $mcount = Message::getInstance()->where("toid", "eq", $usersession["id"])->where("status", "eq", 1)->count();
        if ($mcount > 0) {
            $this->assign("hasnewmessage", 1);
        }
        $this->userinfo = $this->getCurUser();
        $org = Organization::getInstance()->where("id",$this->userinfo["arid"])->find();
        $this->assign("orgname",$org["name"]);
    }

    private function getInfo($info)
    {
        return "<div style='color:#2ED62E;width:100%;text-align:center;'>" . $info . "</div>";
>>>>>>> 7ddf4b56fa75f25b9e4e1a557868f5e04d49a1d4
    }

}