<?php
namespace Databases\Migrations;

use Ububs\Core\Component\Db\Migrations\Migration;
use Ububs\Core\Component\Db\Schema;

class User extends Migration
{

    public function run()
    {
        $table = 'user';
        if (!Schema::isExist($table)) {
            Schema::create($table, function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('username', 30)->default('')->comment('用户名');
                $table->char('password', 40)->default('')->comment('密码');
                $table->string('mail', 30)->default('')->comment('邮箱地址');
                $table->string('face', 255)->default('')->comment('头像');
                $table->tinyInteger('gender', 4)->unsigned()->default(0)->comment('性别dict');
                $table->char('last_login_ip', 15)->default('')->comment('最后登录ip');
                $table->integer('last_login_time', 10)->unsigned()->default(0)->comment('最后登录时间');
                $table->integer('created_at', 10)->unsigned()->default(0)->comment('创建时间');
                $table->tinyInteger('status')->default(0)->comment('状态(0|1');

                // 索引
                $table->index('username', 'index_username');
                $table->index('mail', 'index_mail');
            });
        }
    }
}
