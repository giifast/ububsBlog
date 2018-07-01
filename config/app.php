<?php

return [
    'server_type'        => 'swoole_http_server',
    'server_client'      => '\App\Http\Client',
    'swoole_http_server' => [
        'host'                     => '0.0.0.0',
        'port'                     => '9501',
        'worker_num'               => 4,
        'daemonize'                => false,
        'max_request'              => 10000,
        // 抢占模式
        'dispatch_mode'            => 3,
        'debug_mode'               => 1,
        'task_worker_num'          => 4,
        // 心跳检查间隔时间
        'heartbeat_check_interval' => 100,
        // 连接最大的空闲时间
        'heartbeat_idle_time'      => 300,
    ],
    'logs'               => [
        /**
         * 日志记录的间隔
         * one : 记录同一个文件
         * monute : 每分钟
         * date : 每天
         * month : 每月
         */
        'record_time_interval' => 'date',
        /**
         * 日志文件名前缀
         */
        'file_name_prefix'     => 'FwSwoole_',
        /**
         * 日志文件后缀
         */
        'file_name_suffix'     => 'php',
    ],
    'timezone'           => 'Asia/Shanghai',
    'database'           => [
        // 暂时只支持pdo连接方式
        'type'         => 'pdo',
        'host'         => '127.0.0.1',
        'port'         => '3306',
        'databaseName' => 'test',
        'user'         => 'root',
        'password'     => '123456',
        'charset'      => 'utf8',
    ],
    'website_encrypt'    => 'linlm1994@gmail.com',
    'encrypt_key'        => '29dade9304436266ab7b487132bd8b1a98bc7641',
    'cache'              => [
        'type' => 'redis',
        'port' => 6379,
    ],
    'mail'               => [
        'deiver'   => 'smtp',
        'host'     => 'smtp.qq.com',
        'port'     => 465,
        'encrypt'  => 'ssl',
        'username' => '292304400@qq.com',
        'password' => 'plzicovtdtzgbhjg',
        'fromName' => 'Mailer',
    ],
    'token_expire_time' => 7200
];
