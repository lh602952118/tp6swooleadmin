<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/3
 * Time: 14:12
 */

namespace app\middleware;


use app\admin\model\Mainmenu;
use app\admin\model\MenuPower;
use app\admin\model\Users;

class CkPower
{
    public function handle($request, \Closure $next)
    {
        $adminId = $request->get("adminId");
        $haspw = $this->checkMenuPower($adminId);
        if ($haspw === false) {
            return response()->data('<div style="width: 100%;text-align: center;">' . '您没有权限使用该功能</div>')->code(404);
        }
        return $next($request);
    }

    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 检查用户权限
     * Param:
     * Return:
     * Data: 2019/12/3 14:06
     */
    private function checkMenuPower($adminId)
    {
        $con = \think\facade\Request::controller(true);
        $action = \think\facade\Request::action(true);
        if ($adminId == "SPUSER") {
            return true;
        } else {
            $hasts = Mainmenu::where("controller", $con)->where("method", $action)->where("level", 999)->count();
//        errorlog($action,$con."###".$adminId);
//            errorlog($hasts, "####");
            if ($hasts > 0) {//如果当前地址在特殊权限中，检查是否符合特殊权限
                $admin = Users::where("id", $adminId)->find();
                $pwid = $admin["pwid"];
                $haspowers = MenuPower::where("pwid", $pwid)->select();

                foreach ($haspowers as $p) {
                    $menu = Mainmenu::where("id", $p["mid"])->find();
//                errorlog($menu["controller"]."/".$menu["method"],$con."/".$action);
                    if (strtolower(trim($menu["controller"])) == $con and strtolower(trim($menu["method"])) == $action) {
                        return true;
                    }
                }
                return false;
            }
            return true;
        }
    }
}