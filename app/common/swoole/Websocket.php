<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/4
 * Time: 16:21
 */

namespace app\common\swoole;

use app\common\lib\Redis;
use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WebsocketServer;
use think\Config;
use think\Request;
use think\swoole\contract\websocket\HandlerInterface;
use think\swoole\websocket\socketio\Packet;

class Websocket implements HandlerInterface
{
    /** @var WebsocketServer */
    protected $server;

    /** @var Config */
    protected $config;

    public function __construct(Server $server, Config $config)
    {
        $this->server = $server;
        $this->config = $config;
        //新增服务端口号
        $server->listen("127.0.0.1",8080,SWOOLE_SOCK_TCP);
    }

    /**
     * "onOpen" listener.
     *
     * @param int     $fd
     * @param Request $request
     */
    public function onOpen($fd, Request $request)
    {
        if (!$request->param('sid')) {
            $payload = json_encode(
                [
                    'sid'          => base64_encode(uniqid()),
                    'upgrades'     => [],
                    'pingInterval' => $this->config->get('swoole.websocket.ping_interval'),
                    'pingTimeout'  => $this->config->get('swoole.websocket.ping_timeout'),
                ]
            );
            $initPayload    = Packet::OPEN . $payload;
            $connectPayload = Packet::MESSAGE . Packet::CONNECT;
            Redis::getInstance()->sadd($this->config->get("redis.con_key"),$fd);
            var_dump(Redis::getInstance()->get($this->config->get("redis.con_key")));
            var_dump($this->config->get("redis.con_key"));
            $this->server->push($fd, $payload["sid"]);
//            $this->server->push($fd, $connectPayload);
           $this->server->push($fd, uniqid());
//            $this->server->push($fd, $fd);
        }
    }

    /**
     * "onMessage" listener.
     *  only triggered when event handler not found
     *
     * @param Frame $frame
     * @return bool
     */
    public function onMessage(Frame $frame)
    {
        $packet = $frame->data;
        if (Packet::getPayload($packet)) {
            return false;
        }

        $this->checkHeartbeat($frame->fd, $packet);

        return true;
    }

    /**
     * "onClose" listener.
     *
     * @param int $fd
     * @param int $reactorId
     */
    public function onClose($fd, $reactorId)
    {
        Redis::getInstance()->srem($this->config->get("redis.con_key"),$fd);
        return;
    }

    protected function checkHeartbeat($fd, $packet)
    {
        $packetLength = strlen($packet);
        $payload      = '';

        if ($isPing = Packet::isSocketType($packet, 'ping')) {
            $payload .= Packet::PONG;
        }

        if ($isPing && $packetLength > 1) {
            $payload .= substr($packet, 1, $packetLength - 1);
        }

        if ($isPing) {
            $this->server->push($fd, $payload);
        }
    }
}
