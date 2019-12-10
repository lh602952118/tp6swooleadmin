<?php

namespace app\common\lib;
/**
 * @Author: MrLi
 * @Date: 2019/11/20 10:23
 * @Desc: 获取Redis
 */
class Redis
{
    static $testKey = "test_";
    public $redis = null;
    protected static $instance;

    protected function __clone()
    {
    } //禁止被克隆

    function __construct($host="127.0.0.1",$port=6379)
    {
        $this->redis = new \Swoole\Coroutine\Redis();
        $this->redis->connect($host,$port);
    }
    /**
     * 单例
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self(config("redis.host"),config("redis.port"));
        }
        return self::$instance;
    }
<<<<<<< HEAD
    /**
       * Author: MrLi (602952118@qq.com)
       * Desc: 设置缓存
       * Param:
       * Return:
       * Data: 2019/12/9 14:18
     */
=======
>>>>>>> 7ddf4b56fa75f25b9e4e1a557868f5e04d49a1d4
    function set($key,$val,$time = 0){
        if(empty($key)){
            return "";
        }
        if(is_array($val)){
            $val = json_encode($val);
        }
        if(!$time){
            return $this->redis->set($key,$val);
        }
        return $this->redis->set($key,$val,$time);

    }
<<<<<<< HEAD
    /**
       * Author: MrLi (602952118@qq.com)
       * Desc: 获取主键值
       * Param:
       * Return:
       * Data: 2019/12/9 14:17
     */
=======
>>>>>>> 7ddf4b56fa75f25b9e4e1a557868f5e04d49a1d4
    function get($key){
        if(empty($key)){
            return "";
        }
<<<<<<< HEAD
        return $this->redis->get($key);
    }
    /**
       * Author: MrLi (602952118@qq.com)
       * Desc: 添加序列
       * Param:
       * Return:
       * Data: 2019/12/9 14:17
     */
    function sadd($key,$val){
        return $this->redis->sAdd($key,$val);
    }
    /**
       * Author: MrLi (602952118@qq.com)
       * Desc: 删除序列
       * Param:
       * Return:
       * Data: 2019/12/9 14:17
     */
    function srem($key,$val){
        return $this->redis->srem($key,$val);
    }

    function sMembers($key){
        if($key){
            return $this->redis->sMembers($key);
        }
        return false;
    }
    /**
       * Author: MrLi (602952118@qq.com)
       * Desc: 清空所有缓存
       * Param:
       * Return:
       * Data: 2019/12/10 9:19
     */
    function flashAll(){
        return $this->redis->flushAll();
=======
        return$this->redis->get($key);
>>>>>>> 7ddf4b56fa75f25b9e4e1a557868f5e04d49a1d4
    }
}