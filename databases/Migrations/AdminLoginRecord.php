<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class AdminLoginRecord extends Migration
{

    public function run()
    {
        $table = 'admin_login_record';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('admin_id', 10)->unsigned()->comment('管理员id');
                $table->integer('login_time', 10)->unsigned()->default(0)->comment('登录时间');
                $table->char('login_ip', 15)->default('')->comment('登录ip');
                $table->string('login_address', 30)->default('')->comment('登录地址');
            });
        }
    }
}
