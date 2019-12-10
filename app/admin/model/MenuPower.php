<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 11:05
 */

namespace app\admin\model;

use app\common\model\DModel;

/**
 * @Author: MrLi
 * @Date: 2019/11/25 15:37
 * @Desc: 权限菜单表
 */
class MenuPower extends DModel
{
    // 模型初始化
    protected static function init()
    {
        //TODO:初始化内容
    }

    public function getItems()
    {
        // TODO: Implement getItems() method.
    }

    public function getPageItems()
    {
        // TODO: Implement getPageItems() method.
    }

    /**
     * Author: MrLi (602952118@qq.com)
     * Desc: 添加用户权限
     * Param: pid 用户权限表id
     * Return:
     * Data: 2019/12/2 13:14
     */
    public function addPowerMenu($pwid)
    {
        $in = input();
        $mids = $in["mids"];
        self::startTrans();
        try {
            foreach ($mids as $mid) {
                $con["id"] = getChuanMa("PM");
                $con["mid"] = $mid;
                $con["pwid"] = $pwid;
                self::create($con);
            }
            self::commit();
        } catch (\PDOException $e) {
            self::rollback();
            errorlog("添加用户权限错误", $e->getMessage());
            return false;
        }
        return true;
    }
    /**
       * Author: MrLi (602952118@qq.com)
       * Desc: 删除权限关联
       * Param:
       * Return:
       * Data: 2019/12/2 13:29
     */
    public function delMenuPower($pwid)
    {
        self::where("pwid",$pwid)->delete();
    }
}