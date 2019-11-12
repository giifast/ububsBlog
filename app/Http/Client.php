<?php

namespace App\Http;

class Client
{
    /**
     * 服务端开启动作回调
     * @param  object $serv server对象
     * @return void
     */
    public function onStart($serv)
    {

    }

    /**
     * 服务端进程开启动作回调
     * @param  object $serv      server对象
     * @param  int    $worker_id 进程id
     * @return void
     */
    public function onWorkerStart($serv, $worker_id)
    {

    }

    /**
     * 进程启动报错回调
     * @param  swoole_server $serv       [description]
     * @param  int           $worker_id  [description]
     * @param  int           $worker_pid [description]
     * @param  int           $exit_code  [description]
     * @param  int           $signal     [description]
     * @return [type]                    [description]
     */
    public function onWorkerError(swoole_server $serv, int $worker_id, int $worker_pid, int $exit_code, int $signal)
    {}

    /**
     * task 动作回调
     * @return void
     */
    public function onTask($serv, $task_id, $from_id, $data)
    {

    }

    /**
     * finish 动作回调
     * @return void
     */
    public function onFinish($serv, $task_id, $data)
    {

    }

    /**
     * websocket open
     * @param  [type] $server  [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function onOpen($server, $request)
    {

    }

    /**
     * websocket message
     * @param  [type] $server [description]
     * @param  [type] $frame  [description]
     * @return [type]         [description]
     */
    public function onMessage($server, $frame)
    {

    }

    /**
     * websocket close
     * @param  [type] $server [description]
     * @param  [type] $fd     [description]
     * @return [type]         [description]
     */
    public function onClose($server, $fd)
    {

    }

}
