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
 * @Desc: 用户表
 */
class Users extends DModel{
//    protected $pk = 'uid'; //如果你没有使用id作为主键名，需要在模型中设置属性：
    // 设置当前模型对应的完整数据表名称
//    protected $table = 'think_user';

    // 设置当前模型的数据库连接
//    protected $connection = 'db_config';

    //模型的数据字段和对应数据表的字段是对应的，默认会自动获取（包括字段类型），但自动获取会导致增加一次查询，因此你可以在模型中明确定义字段信息避免多一次查询的开销。
    // 设置字段信息
//    protected $schema = [
//        'id'          => 'varchar',
//        'username'          => 'varchar',
//        'password'        => 'varchar',
//        'uslevel'      => 'int',
//        'realname'       => 'varchar',
//        'phone' => 'varchar',
//        'qqnum'          => 'varchar',
//        'nikename'        => 'varchar',
//        'email'      => 'varchar',
//        'sign'       => 'varchar',
//        'headimg' => 'varchar',
//        'openid' => 'varchar',
//        'cardnum'          => 'varchar',
//        'desc'        => 'varchar',
//        'addtime'      => 'varchar',
//        'ewm'       => 'varchar',
//        'iszz' => 'varchar',
//        'arid' => 'varchar',
//        'updatetime'          => 'varchar',
//        'skey'        => 'varchar',
//        'nickname'      => 'varchar',
//        'gender'       => 'int',
//        'avatarurl' => 'varchar',
//        'pjrs' => 'varchar',
//        'zfs'          => 'varchar'
//    ];
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
    //如果你是在模型内部获取数据的话，需要改成：
    //
    //$user = $this->find(1);
    //echo $user->getAttr('create_time');
    //echo $user->getAttr('name');

}