<?php
namespace app\admin\controller;

use app\BaseController;
use app\common\controller\HController;
use app\common\lib\Redis;
use app\middleware\CkPower;
use think\facade\View;

class Index extends HController
{
    protected $middleware = [CkPower::class];
    public function index()
    {

//        var_dump(\think\facade\Db::table('test')->where('id', 1)->find());
//        $redis = Redis::getInstance();
//        $redis->set("aaa",2);
//        echo $redis->get("aaa");

       return view("index");
    }
    public function welcome(){
        return view();
    }
    public function test1(){
        return 'this is a test1';
    }
    public function test2($name = "tinkphp6"){
        return 'this is a test2'.$name;
    }
    function edituser(){
        echo 11111;
    }

}
