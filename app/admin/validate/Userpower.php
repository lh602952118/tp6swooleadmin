<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 17:06
 */

namespace app\admin\validate;

use think\Validate;

class Userpower extends Validate
{
    protected $rule = [
        'name' => 'require',
        'level' => 'require',
    ];

    protected $message = [
        'name.require' => '请填写权限名称',
        'level.require' => '请选择级别编号',
    ];
}