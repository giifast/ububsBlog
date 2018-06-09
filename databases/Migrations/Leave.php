<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class Leave extends Migration
{

    public function run()
    {
        $table = 'leave_message';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('mail', 30)->default('')->comment('邮箱');
                $table->string('content', 255)->default('')->comment('内容');
                $table->string('address', 30)->default('')->comment('地址');
                $table->string('ip_address', 30)->default('')->comment('ip地址');
                $table->integer('created_at', 10)->unsigned()->default(0)->comment('创建时间');
                $table->tinyInteger('status')->default(0)->comment('状态');
            });
        }
    }
}
