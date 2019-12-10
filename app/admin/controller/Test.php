<?php

namespace app\admin\controller;

use app\admin\controller\user\User;
use app\admin\model\Mainmenu;
use app\admin\model\MenuPower;
use app\admin\model\UserPower;
use app\common\controller\HController;
use app\common\lib\Redis;
use app\common\lib\Util;
use app\middleware\CkPower;
use think\Db;
use think\db\exception\PDOException;
use think\facade\View;

/**
 * @Author: MrLi
 * @Date: 2019/11/25 16:33
 * @Desc: 菜单管理
 */
class Test extends HController
{
    protected $middleware = [CkPower::class];
    function manage()
    {
        $in = input();
        $items = $this->getItems();
        $this->assign("count", $items[1]);
        $this->assign("page", $items[1]);
        $this->assign("items", $items[0]);

        if ($in["isss"] == 1) {
            return view("tablepage");
        } elseif ($in["isss"] == 2) {
            return view("getstatusorders");
        } else {
            return view();
        }
    }


    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 添加项目
     * Param:
     * Return:
     * Data: 2019/8/27 11:02
     */
    function additems()
    {
//        $in = input();
//        $id = $in["id"];
//        $con["name"] = $in["name"];
//        $con["level"] = $in["level"];
//        try {
//            validate(\app\admin\validate\Mainmenu::class)->check($con);
//        } catch (ValidateException $e) {
//            // 验证失败 输出错误信息
//            return Util::getReturn(config("code.error"), $e->getError());
//        }
//        if ($id != "") {//修改
//            $con["id"] = $id;
//            MenuPower::where("pwid", $id)->delete();
//            MenuPower::addPowerMenu($id);
//            UserPower::update($con);
//
//
//            return Util::getReturn(config("code.success"), "修改成功");
//        } else {//添加
//            $con["id"] = getChuanMa("PW");
//            $con["add_time"] = time();
//
//            UserPower::create($con);
//            MenuPower::addPowerMenu($con["id"]);
//
//
//            return Util::getReturn(config("code.success"), "添加成功");
//        }
//         errorlog("aaa",config("redis.con_key").":".json_encode());
        $clients = Redis::getInstance()->sMembers(config("redis.con_key"));
        foreach ($clients as $fd){
            $_POST["http_server"]->push($fd,json_encode($clients));
        }
        return 1;
    }

    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 编辑列表
     * Param:
     * Return:
     * Data: 2019/8/27 15:25
     */
    function editorg()
    {
        $in = input();
        $id = $in["id"];
        if ($id != "") {
            $item = UserPower::where("id", $id)->find();
            $mids = MenuPower::where("pwid", $item["id"])->select();
            $item["mids"] = $mids;
            $this->assign("item", $item);
            return View::fetch("tadditem");
        }
    }


    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 删除项目
     * Param:
     * Return:
     * Data: 2019/8/27 16:09
     */
    function delItem()
    {
        $in = input();
        $id = $in["id"];
        try {
            //查看有无子菜单 如果有 无法删除
            $hasson = Mainmenu::where("pid", $id)->count();
            if ($hasson > 0) {
                return 3;
            }
            Mainmenu::where("id", $id)->delete();
        } catch (PDOException $e) {
            return 2;
        }
        return 1;
    }

    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 后台列表
     * Param:
     * Return:
     * Data: 2019/3/21 15:14
     */
    function getItems($type = 1)
    {
        if ($type == 1) {
            $pr = $this->getserchparameters();
            $arr = $pr[0];
            $sql = $pr[1];
        } else {
            $arr = [];
        }

        if (count($arr) > 0) {
            $count = UserPower::where($sql, $arr)->count();
            $pagenum = input("page") == "" ? 0 : input("page");
            $con = UserPower::order("add_time", "desc")->where($sql, $arr)->limit(($pagenum <= 1 ? 0 : $pagenum - 1) * getPageLimite(), getPageLimite())->select();
        } else {
            $count = UserPower::count();
            $pagenum = input("page") == "" ? 0 : input("page");
            $con = UserPower::order("add_time", "desc")->limit(($pagenum <= 1 ? 0 : $pagenum - 1) * getPageLimite(), getPageLimite())->select();
        }
        return [$con, $count];
    }

    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 获取搜索参数
     * Param:
     * Return:
     * Data: 2019/7/2 9:53
     */
    function getserchparameters()
    {
        $in = input();
        $sql = "";
        $arr = [];

        if (trim($in["name"]) != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            $sql .= " name LIKE :name ";
            $arr["name"] = "%" . trim($in["name"]) . "%";
        }

        return [$arr, $sql];
    }

    public function searchControllerAttr($query, $value, $data)
    {
        $query->where("controller", "like", "%" . trim($value) . "%");
    }

    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 查看机构详情
     * Param:
     * Return:
     * Data: 2019/10/14 14:42
     */
    function lookitem()
    {
        $in = input();
        $id = $in["id"];
        if ($id != "") {
            $org = SystemAdmin::getInstance()->where("id", $id)->find();
            if ($org["id"] != "") {
                //统计教师人数
                $tcnum = SystemAdmin::getInstance()->where("pid", $id)->order("add_time", "asc")->where("is_del", 0)->select();
                $org["tcnum"] = count($tcnum) == "" ? 0 : count($tcnum);
                //统计每位老师学生人数 及总人数
                $tcs = [];
                $snum = 0;
                foreach ($tcnum as $tc) {
                    $stnum = SystemAdmin::getInstance()->where("pid", $tc["id"])->where("is_del", 0)->count();
                    $data["tcname"] = $tc["real_name"] == "" ? $tc["username"] : $tc["real_name"];
                    $data["stnmu"] = $stnum == "" ? 0 : $stnum;
                    $tcs[] = $data;
                    $snum += $stnum;
                }
                $org["tcstes"] = $tcs;//老师包含的学生人数数组
                $org["snum"] = $snum;//总学生人数
                //根据考试统计每次考试报考人数
                $this->assign("orginfo", $org);
                return $this->fetch();
            }

        }

    }

}
