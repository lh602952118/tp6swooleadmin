<?php

namespace app\common\lib;
/**
 * @Author: MrLi
 * @Date: 2019/11/20 10:23
 * @Desc: Server 监听服务
 */
class Server
{
    const PORT = 80;
    public function port(){
        $shell = "netstat -anp 2>/dev/null | grep ".self::PORT." | grep LISTEN | wc -l";
        $result = shell_exec($shell);
        if($result != 1){
            echo data("Ymd H:i:s")." 服务已停止 Error".PHP_EOL;
        }else{
            echo data("Ymd H:i:s")." 服务正常运行 Success".PHP_EOL;
        }
    }
}
//swoole 定时器
swoole_timer_tick(2000,function ($timer_id){
    $server = new Server();
    $server->port();
    echo "time——start".PHP_EOL;
});
//nohup /home/php server.php a.txt &  将输入记录在日志中
//进程是否启用  ps aux | grep server.php
//tail -f a.txt  查看文档
//df -h 查看文件系统
//elasticserch hadoop