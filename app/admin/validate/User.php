<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 17:06
 */

namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
    ];

    protected $message = [
        'username.require' => '必须填写用户名',
        'password.require' => '必须输入密码',
    ];
}