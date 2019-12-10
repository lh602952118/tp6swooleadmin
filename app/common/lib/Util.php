<?php

namespace app\common\lib;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/20
 * Time: 9:40
 */
class Util
{
    /**
       * Author: MrLi (602952118@qq.com)
       * Desc: 返回前端JSon 数据
       * Param:
       * Return:
       * Data: 2019/11/20 9:42
     */
    static function getReturn($status, $message = "",$data = [])
    {
        $result = [
            "status" => $status,
            "message" => $message,
            "data" => $data
        ];
        return json_encode($result);
    }
}