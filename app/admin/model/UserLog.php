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
 * @Date: 2019/11/25 16:00
 * @Desc: 用户日志表
 */
class UserLog extends DModel{

    // 模型初始化
    protected static function init()
    {
        //TODO:初始化内容
    }
    function saveLog($name,$content = "")
    {
        try{
            $con["id"] = getChuanMa("LG");
            $con["name"] = $name;
            $con["content"] = $content;
            $con["logtime"] = time();
            $con["ipaddr"] = getIP();
            $con["uid"] = 1;
            self::create($con);
            return $con["id"];
        }catch (\PDOException $e){
            return false;
        }

    }
    public function getItems()
    {
        // TODO: Implement getItems() method.
    }
    public function getPageItems()
    {
        // TODO: Implement getPageItems() method.
    }
    //如果你是在模型内部获取数据的话，需要改成：
    //
    //$user = $this->find(1);
    //echo $user->getAttr('create_time');
    //echo $user->getAttr('name');

}