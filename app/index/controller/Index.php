<?php
namespace app\index\controller;

use app\BaseController;
use app\common\controller\HController;
use app\common\controller\QController;
use app\common\lib\Redis;
use think\facade\View;

class Index extends QController
{
    public function index()
    {

//        var_dump(\think\facade\Db::table('test')->where('id', 1)->find());
//        $redis = Redis::getInstance();
//        $redis->set("aaa",2);
//        echo $redis->get("aaa");
       return view("index");
    }
    public function test(){
        $re = Redis::getInstance();
        echo $re->get("aaa");
    }
    public function test1(){
        return 'this is a test1';
    }
    public function test2($name = "tinkphp6"){
        return 'this is a test2'.$name;
    }

}
