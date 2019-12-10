<?php

namespace app\admin\controller;

use app\admin\model\Mainmenu;
use app\admin\model\UserLog;
use app\common\controller\HController;
use app\common\lib\Util;
use app\middleware\CkPower;
use think\App;
use think\db\exception\PDOException;
use think\exception\ValidateException;
use think\facade\View;

/**
 * @Author: MrLi
 * @Date: 2019/11/25 16:33
 * @Desc: 菜单管理
 */
class Menu extends HController
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
        $con["name"] = $in["name"];
        $con["iheight"] = $in["iheight"];
        $con["iwidth"] = $in["iwidth"];
        $con["sort"] = $in["sort"];
        $con["parameter"] = $in["parameter"];
        $con["controller"] = $in["controller"];
        $con["method"] = $in["method"];
        $pid = $in["pid"];
        switch ($pid) {
            case 999:
                $con["level"] = 999;
                $con["tsid"] = $in["tsid"];
                $con["pid"] = $pid;
                break;
            case 1:
                $con["level"] = 1;
                break;
            default:
                $mn = Mainmenu::where("id", $pid)->find();
                if ($mn["level"] == 1) {
                    $con["level"] = 2;
                }
                if ($mn["level"] == 2) {
                    $con["level"] = 3;
                }
                $con["pid"] = $pid;
                break;
        }
        $con["itype"] = $in["itype"];
        switch ($con["itype"]) {
            case 2://lay图标
                $con["img"] = $in["img"];
                break;
            case 3://自定义
                $con["img"] = $in["simg"];
                break;
        }
        $con["status"] = 1;
        $con["is_show"] = $in["is_show"];
        $con = repemp($con);
        try {
            validate(\app\admin\validate\Mainmenu::class)->check($con);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return Util::getReturn(config("code.error"), $e->getError());
        }
        if ($id != "") {//更新
            $con["id"] = $id;
            try{
                Mainmenu::update($con);
            }catch (PDOException $e2){
                return Util::getReturn(config("code.error"), $e2->getMessage());
            }
            return Util::getReturn(config("code.success"), "更新成功");
        } else {//新增
            $con["id"] = getChuanMa("MN");
            $con["add_time"] = time();
            try{
                Mainmenu::create($con);
            }catch (PDOException $e1){
                return Util::getReturn(config("code.error"), $e1->getMessage());
            }
            return Util::getReturn(config("code.success"), "添加成功");
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
            $item = Mainmenu::where("id", $id)->find();
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
        try{
            //查看有无子菜单 如果有 无法删除
            $hasson = Mainmenu::where("pid", $id)->count();
            if($hasson > 0){
                return 3;
            }
            Mainmenu::where("id", $id)->delete();
        }catch (PDOException $e){
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
            $count = Mainmenu::where($sql, $arr)->count();
            $pagenum = input("page") == "" ? 0 : input("page");
            $con = Mainmenu::order("add_time", "desc")->where($sql, $arr)->limit(($pagenum <= 1 ? 0 : $pagenum - 1) * getPageLimite(), getPageLimite())->select();
        } else {
            $count = Mainmenu::count();
            $pagenum = input("page") == "" ? 0 : input("page");
            $con = Mainmenu::order("add_time", "desc")->limit(($pagenum <= 1 ? 0 : $pagenum - 1) * getPageLimite(), getPageLimite())->select();
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
        if (trim($in["pid"]) != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            $sql .= " pid = :pid ";
            $arr["pid"] = $in["pid"];
        }
        if (trim($in["controller"]) != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            $sql .= " controller LIKE :controller ";
            $arr["controller"] = "%" . trim($in["controller"]) . "%";
        }
        if (trim($in["method"]) != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            $sql .= " method LIKE :method ";
            $arr["method"] = "%" . trim($in["method"]) . "%";
        }
        $level = explode(",", $in["level"]);
        if (count($level) > 0 and $level[0] != "") {
            if (count($arr) > 0) {
                $sql .= " AND ";
            }
            for ($i = 0; $i < count($level); $i++) {
                if ($i == 0) {
                    $sql .= " ( ";
                }
                $sql .= " level = :st$i ";
                if ($i != (count($level) - 1)) {
                    $sql .= " OR ";
                }
                $arr["st$i"] = $level[$i];
                if ($i == (count($level) - 1)) {

                    $sql .= " ) ";
                }
            }
        }

        return [$arr, $sql];
    }

}
