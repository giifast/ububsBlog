<?php

return [
    'website-dump' => [
        'title'      => 'mysql数据备份资料',
        'valid_time' => 3600,
        'class'      => \App\Repositories\Backend\WebsiteRepository::class,
        'method' => 'dumpDownload'
    ],

];
