<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 11:05
 */

namespace app\admin\model;

use app\admin\controller\Power;
use app\common\model\DModel;
/**
 * @Author: MrLi
 * @Date: 2019/11/25 16:01
 * @Desc: 功能表
 */
class Mainmenu extends DModel
{

    // 模型初始化
    protected static function init()
    {
        //TODO:初始化内容
    }

    public function getItems()
    {
        $ones = Mainmenu::where("level", 1)->where("is_show",1)->where("level","not in","0,999")->order("sort", "asc")->select();
        $o = [];

        foreach ($ones as $one) {

                $twos = Mainmenu::where("pid", $one["id"])->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
                $t = [];
                foreach ($twos as $two) {
                    $third = Mainmenu::where("pid", $two["id"])->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
                    $two["sons"] = $third;
                    $t[] = $two;

                }
                $one["sons"] = $t;
//                $one["name"] = $one["name"];
                $o[] = $one;


        }
        return $o;
    }

    public function getPowerMenus2($adminId)
    {
        if($adminId == "SPUSER"){
            $ones = Mainmenu::where("level", 1)->where("is_show",1)->where("level","not in","0,999")->order("sort", "asc")->select();
            $o = [];
            foreach ($ones as $one) {

                $twos = Mainmenu::where("pid", $one["id"])->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
                $t = [];
                foreach ($twos as $two) {
                    $third = Mainmenu::where("pid", $two["id"])->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
                    $two["sons"] = $third;
                    $t[] = $two;
                }
                $one["sons"] = $t;
//                $one["name"] = $one["name"];
                $o[] = $one;
            }
            return $o;
        }else{
            $admin = Users::where("id",$adminId)->find();
            $pwid = $admin["pwid"];
            $haspowers = MenuPower::where("pwid",$pwid)->field("mid")->select();
            $mids = "";
            for($i=0;$i<count($haspowers);$i++){
                $mids .= $haspowers[$i]["mid"];
                if($i != (count($haspowers)-1)){
                    $mids .= ",";
                }
            }
//        errorlog("mids",$mids);
            $ones = Mainmenu::where("level", 1)->where("id","in",$mids)->where("is_show",1)->where("level","not in","0,999")->order("sort", "asc")->select();
            $o = [];
            foreach ($ones as $one) {

                $twos = Mainmenu::where("pid", $one["id"])->where("id","in",$mids)->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
                $t = [];
                foreach ($twos as $two) {
                    $third = Mainmenu::where("pid", $two["id"])->where("id","in",$mids)->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
                    $two["sons"] = $third;
                    $t[] = $two;
                }
                $one["sons"] = $t;
//                $one["name"] = $one["name"];
                $o[] = $one;
            }
            return $o;
        }

    }

    function getPowerMenus(){
        $ones = Mainmenu::where("level", 1)->where("is_show",1)->where("level","not in","0,999")->order("sort", "asc")->select();
        $o = [];
        foreach ($ones as $one) {

            $twos = Mainmenu::where("pid", $one["id"])->whereOr("tsid",$one["id"])->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
            $t = [];
            foreach ($twos as $two) {
                $third = Mainmenu::where("pid", $two["id"])->whereOr("tsid",$two["id"])->where("level","not in","0,999")->where("is_show",1)->order("sort", "asc")->select();
                $two["sons"] = $third;
                $t[] = $two;

            }
            $one["sons"] = $t;
//                $one["name"] = $one["name"];
            $o[] = $one;


        }
        return $o;
    }

    public function getPageItems()
    {
        // TODO: Implement getPageItems() method.
    }

}