<?php

namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class ChatContent extends Migration
{

    public function run()
    {
        $table = 'chat_contents';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('rid')->unsigned()->comment('房间号');
                $table->char('ip', 15)->unsigned()->comment('ip');
                $table->string('content', 255)->comment('内容');
                $table->integer('created_at', 10)->unsigned()->default(0)->comment('创建时间');
                $table->integer('deleted_at', 10)->unsigned()->default(0)->comment('加入回收站时间');
            });
        }
    }
}
