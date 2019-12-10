<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/21
 * Time: 17:06
 */

namespace app\admin\validate;

use think\Validate;

class Mainmenu extends Validate
{
    protected $rule = [
        'name' => 'require',
    ];

    protected $message = [
        'name.require' => '请填写菜单名称',
    ];
}