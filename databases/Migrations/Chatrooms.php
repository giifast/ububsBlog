<?php

namespace Databases\Migrations;

use Ububs\Core\Component\Db\Schema;
use Ububs\Core\Component\Db\Migrations\Migration;

class Chatrooms extends Migration
{

    public function run()
    {
        $table = 'chatrooms';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name', 50)->default('')->comment('名称');
                $table->integer('creator')->unsigned()->default(0)->comment('创建人');
                $table->tinyInteger('status')->unsigned()->default(0)->comment('状态dict');
                $table->integer('created_at', 10)->unsigned()->default(0)->comment('创建时间');
                $table->integer('deleted_at', 10)->unsigned()->default(0)->comment('加入回收站时间');
                // 索引
                $table->index('creator', 'index_creator');
            });
        }
    }
}
