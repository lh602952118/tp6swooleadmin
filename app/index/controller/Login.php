<?php
namespace app\admin\controller;

use app\BaseController;
use app\common\lib\Redis;

class Login extends BaseController
{
    public function index()
    {
       return view("index");

    }
    public function test(){
        $re = Redis::getInstance();
        echo $re->get("aaa");
    }
    public function login(){
        $in = input();
        return json_encode($in);
    }
    public function test2($name = "tinkphp6"){
        return 'this is a test2'.$name;
    }

}
