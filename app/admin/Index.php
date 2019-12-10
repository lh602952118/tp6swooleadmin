<?php
namespace app\admin;

use app\BaseController;
use app\common\lib\Redis;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {

//        var_dump(\think\facade\Db::table('test')->where('id', 1)->find());
//        $redis = Redis::getInstance();
//        $redis->set("aaa",2);
//        echo $redis->get("aaa");
        return View::fetch("index.html");
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
