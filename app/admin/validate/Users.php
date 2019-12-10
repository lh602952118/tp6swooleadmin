<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 17:06
 */

namespace app\admin\validate;

use think\Validate;

class Users extends Validate
{
    protected $rule = [
        'pwid' => 'require',
        'is_use' => 'require',
        'username' => 'require'
    ];

    protected $message = [
        'pwid.require' => '请选择要使用的权限',
        'is_use.require' => '请选择是否启用',
        'username.require' => '必须填写用户名',
    ];
}