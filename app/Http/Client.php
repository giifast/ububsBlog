<?php
namespace App\Http;

use Ububs\Core\Component\Db\Db;
use Ububs\Core\Component\Log\Log;
use \Swoole\Table;

class Client
{

    public function beforeStart($serv)
    {
        $table = new Table(1024);
        $table->column('rid', Table::TYPE_INT, 4);
        $table->column('ip', Table::TYPE_STRING, 15);
        $table->create();
        $serv->table = $table;
    }
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
    public function onWorkerError($serv, int $worker_id, int $worker_pid, int $exit_code, int $signal)
    {}

    /**
     * task 动作回调
     * @return void
     */
    public function onTask($serv, $task_id, $from_id, $data)
    {
        $c = $data['data'] ?? [];
        switch ($data['type']) {
            case 'error':
                $c['msg'] = 'connect error';
                break;

            case 'login':
                $c['msg']   = 'login success';
                $c['login'] = true;
                break;

            case 'health':
                $c['msg'] = 'success';
                break;

            case 'chat':
                break;
        }
        foreach ($serv->connections as $fd) {
            $infos = $serv->connection_info($fd);
            if ($infos['websocket_status'] != 3) {
                continue;
            }
            $from_fd = $c['fd'] ?? '';
            if ($from_fd == $fd) {
                continue;
            }
            if ($from_fd) {
                if ($ci = $serv->table->get($from_fd)) {
                    $c['ip'] = $ci['ip'] ?? '-';
                }
            }
            $serv->push($fd, json_encode($c), WEBSOCKET_OPCODE_BINARY);
        }
        $serv->finish($c);
    }

    /**
     * finish 动作回调
     * @return void
     */
    public function onFinish($serv, $task_id, $data)
    {
        $fd  = $data['fd'] ?? '';
        $msg = $data['msg'] ?? '';
        if (!$fd || !$msg) {
            return true;
        }
        $row = $serv->table->get($fd);
        if (!$row) {
            Log::error('swoole table has not exist fd');
            return true;
        }
        $insert = [
            'rid'        => $row['rid'] ?? '',
            'ip'         => $row['ip'],
            'content'    => $msg,
            'created_at' => time(),
        ];
        Db::table('chat_contents')->create($insert);
        return true;
    }

    /**
     * websocket open
     * @param  [type] $serv  [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function onOpen($serv, $request)
    {
        try {
            $room_id = mb_substr($request->server['request_uri'], 1);
            $fd      = $request->fd;
            $serv->table->set($fd, array('rid' => $room_id, 'ip' => $request->server['remote_addr']));
            $serv->task(['type' => 'login']);
        } catch (\Exception $e) {
            $serv->task(['type' => 'error']);
        }
    }
    /**
     * websocket message
     * @param  [type] $server [description]
     * @param  [type] $frame  [description]
     * @return [type]         [description]
     */
    public function onMessage($serv, $frame)
    {
        if ($frame->data == 'heartCheck') {
            $serv->task(['type' => 'health']);
        } else {
            $serv->task(['type' => 'chat', 'data' => ['fd' => $frame->fd, 'msg' => $frame->data]]);
        }
    }

    /**
     * websocket close
     * @param  [type] $serv [description]
     * @param  [type] $fd     [description]
     * @return [type]         [description]
     */
    public function onClose($serv, $fd)
    {}

}
