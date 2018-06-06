<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class Admin extends Migration
{

    public function run()
    {
        $table = 'admin';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->smallInteger('role_id')->unsigned()->default(0)->comment('角色id');
                $table->string('account', 30)->comment('用户名');
                $table->string('password', 40)->comment('密码');
                $table->string('face', 255)->default('')->comment('头像');
                $table->string('mail', 30)->comment('邮箱');
                $table->string('last_login_ip', 15)->default('')->comment('最后登录ip');
                $table->integer('last_login_time', 10)->unsigned()->default(0)->comment('最后登录时间');
                $table->integer('created_at', 10)->unsigned()->default(0)->comment('创建时间');
                $table->tinyInteger('status')->default(1)->comment('状态(0|1)');
            });
        }
    }
}
