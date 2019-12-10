<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 11:05
 */
namespace app\common\model;

use app\common\imp\Mimp;
use think\Model;

class DModel extends Model implements Mimp {
//    protected $pk = 'uid'; //如果你没有使用id作为主键名，需要在模型中设置属性：
    // 设置当前模型对应的完整数据表名称
//    protected $table = 'think_user';
    // 设置当前模型的数据库连接
//    protected $connection = 'db_config';
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
}