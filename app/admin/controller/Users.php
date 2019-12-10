<?php

namespace app\admin\controller;

use app\admin\model\Mainmenu;
use app\admin\validate\User;
use app\common\controller\HController;
use app\common\lib\Util;
use app\middleware\CkPower;
use think\db\exception\PDOException;
use think\facade\View;

/**
 * @Author: MrLi
 * @Date: 2019/11/25 16:33
 * @Desc: 菜单管理
 */
class Users extends HController
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
        $in = input();
        $id = $in["id"];
        $con["username"] = $in["username"];
        $con["pwid"] = $in["pwid"];
        $con["is_use"] = $in["is_use"];

        $validate = new \app\admin\validate\Users();

        if (!$validate->check($con)) {
            return Util::getReturn(config("code.error"), $validate->getError());
        }

        if ($id != "") {//更新
            try {
                $con["id"] = $id;
                \app\admin\model\Users::update($con);
            } catch (PDOException $e2) {
                return Util::getReturn(config("code.error"), "用户名已存在，请更换");
            }
            return Util::getReturn(config("code.success"), "更新用户成功");
        } else {//新增
            $con["id"] = getChuanMa("U");
            $con["add_time"] = time();
            $con["password"] = md5("123456");
            try {
                \app\admin\model\Users::create($con);
            } catch (PDOException $e1) {
                return Util::getReturn(config("code.error"), "用户名已存在，请更换");
            }
            return Util::getReturn(config("code.success"), "用户添加成功！密码：123456，请尽快登陆修改");
        }
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
            $item = \app\admin\model\Users::where("id", $id)->find();
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
            $con["id"] = $id;
            $con["is_del"] = 2;
            $con["is_use"] = 2;
            \app\admin\model\Users::update($con);
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
            $count = \app\admin\model\Users::where($sql, $arr)->where("id","<>","SPUSER")->where("is_del",1)->count();
            $pagenum = input("page") == "" ? 0 : input("page");
            $con = \app\admin\model\Users::order("add_time", "desc")->where("id","<>","SPUSER")->where("is_del",1)->where($sql, $arr)->limit(($pagenum <= 1 ? 0 : $pagenum - 1) * getPageLimite(), getPageLimite())->select();
        } else {
            $count = \app\admin\model\Users::where("is_del",1)->where("id","<>","SPUSER")->count();
            $pagenum = input("page") == "" ? 0 : input("page");
            $con = \app\admin\model\Users::order("add_time", "desc")->where("id","<>","SPUSER")->where("is_del",1)->limit(($pagenum <= 1 ? 0 : $pagenum - 1) * getPageLimite(), getPageLimite())->select();
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

        if (trim($in["username"]) != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            $sql .= " username LIKE :username ";
            $arr["username"] = "%" . trim($in["username"]) . "%";
        }
        if (trim($in["real_name"]) != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            $sql .= " realname LIKE :realname ";
            $arr["realname"] = "%" . trim($in["real_name"]) . "%";
        }
        if (trim($in["id"]) != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            $sql .= " id LIKE :id ";
            $arr["id"] = "%" . trim($in["id"]) . "%";
        }
        $is_use = explode(",", $in["is_use"]);
        if (count($is_use) > 0 and $is_use[0] != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            for ($i = 0; $i < count($is_use); $i++) {
                if ($i == 0) {
                    $sql .= " ( ";
                }
                $sql .= " is_use = :st$i ";
                if ($i != (count($is_use) - 1)) {
                    $sql .= " OR ";
                }
                $arr["st$i"] = $is_use[$i];
                if ($i == (count($is_use) - 1)) {

                    $sql .= " ) ";
                }
            }
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
